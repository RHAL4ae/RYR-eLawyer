import pandas as pd
import numpy as np
from sklearn.preprocessing import MinMaxScaler
import matplotlib.pyplot as plt
from dataclasses import dataclass, field
from datetime import datetime

@dataclass
class ClientEvent:
    client_id: str
    event_type: str
    value: float = 1.0
    timestamp: datetime = field(default_factory=datetime.utcnow)

class ClientBehavioralAnalytics:
    def __init__(self):
        self.events = []

    def record_event(self, client_id: str, event_type: str, value: float = 1.0):
        self.events.append(ClientEvent(client_id, event_type, value))

    def _to_dataframe(self):
        return pd.DataFrame([
            {
                "client_id": e.client_id,
                "event": e.event_type,
                "value": e.value,
                "timestamp": e.timestamp,
            }
            for e in self.events
        ])

    def compute_metrics(self):
        df = self._to_dataframe()
        if df.empty:
            return pd.DataFrame()
        df['date'] = df['timestamp'].dt.date
        pivot = df.pivot_table(index=['client_id','date','event'], values='value', aggfunc='sum').unstack(fill_value=0)
        pivot.columns = [c[1] for c in pivot.columns]
        return pivot.reset_index()

    def score_clients(self):
        metrics = self.compute_metrics()
        if metrics.empty:
            return pd.DataFrame()
        metric_cols = [c for c in metrics.columns if c not in ['client_id','date']]
        scaler = MinMaxScaler()
        scaled = scaler.fit_transform(metrics[metric_cols])
        engagement = scaled.mean(axis=1)
        satisfaction = metrics.get('feedback', pd.Series(0, index=metrics.index))
        churn_risk = 1 - engagement
        metrics['engagement'] = engagement
        metrics['satisfaction'] = satisfaction
        metrics['churn_risk'] = churn_risk
        return metrics[['client_id','date','engagement','satisfaction','churn_risk']]

    def visualize_trends(self, client_id: str = None):
        scores = self.score_clients()
        if scores.empty:
            print("No data to visualize")
            return
        if client_id:
            scores = scores[scores['client_id'] == client_id]
        scores.plot(x='date', y=['engagement','satisfaction','churn_risk'])
        plt.title(f'Client Behavioral Trends {client_id or "all"}')
        plt.ylabel('Score')
        plt.tight_layout()
        plt.show()

    def detect_disengagement(self, threshold: float = 0.3):
        scores = self.score_clients()
        if scores.empty:
            return []
        latest = scores.sort_values('date').groupby('client_id').tail(1)
        alerts = latest[latest['churn_risk'] > threshold]
        return alerts['client_id'].tolist()

