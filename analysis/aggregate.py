"""Aggregate tone scores and generate simple visualizations."""

from collections import defaultdict
from typing import List, Dict

import matplotlib.pyplot as plt

from sentiment_tone import ToneAnalyzer


def aggregate_by_field(records: List[Dict[str, str]], field: str) -> Dict[str, List[str]]:
    buckets: Dict[str, List[str]] = defaultdict(list)
    for rec in records:
        buckets[rec.get(field, "unknown")].append(rec["text"])
    return buckets


def compute_aggregate(records: List[Dict[str, str]], field: str) -> Dict[str, Dict[str, float]]:
    analyzer = ToneAnalyzer()
    buckets = aggregate_by_field(records, field)
    aggregate_scores: Dict[str, Dict[str, float]] = {}
    for key, texts in buckets.items():
        totals = defaultdict(float)
        for text in texts:
            scores = analyzer.analyze_text(text)
            for k, v in scores.__dict__.items():
                totals[k] += v
        count = len(texts)
        aggregate_scores[key] = {k: v / count for k, v in totals.items()}
    return aggregate_scores


def plot_aggregate(aggregates: Dict[str, Dict[str, float]], title: str, outfile: str) -> None:
    categories = list(aggregates.keys())
    sentiments = [aggregates[c]["sentiment"] for c in categories]
    plt.figure(figsize=(10, 4))
    plt.bar(categories, sentiments, color="skyblue")
    plt.ylabel("Average sentiment score")
    plt.title(title)
    plt.xticks(rotation=45, ha="right")
    plt.tight_layout()
    plt.savefig(outfile)


if __name__ == "__main__":
    import json
    import sys

    if len(sys.argv) < 3:
        print("Usage: python aggregate.py <records.json> <field>")
        sys.exit(1)

    path = sys.argv[1]
    field = sys.argv[2]
    with open(path, "r", encoding="utf-8") as f:
        records = json.load(f)

    agg = compute_aggregate(records, field)
    plot_aggregate(agg, f"Average sentiment by {field}", f"aggregate_{field}.png")
    print(json.dumps(agg, indent=2))
