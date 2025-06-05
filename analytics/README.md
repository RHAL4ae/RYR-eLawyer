# Client Behavioral Analytics Module

This module provides basic tools to capture client interactions and derive engagement metrics.
It offers utilities to:

- Record events like logins, document uploads, feedback, etc.
- Calculate daily metrics per client.
- Produce engagement, satisfaction and churn risk scores using a simple scaling model.
- Visualize score trends and detect disengagement.

Install dependencies:

```sh
pip install -r requirements.txt
```

Example usage:

```python
from analytics.behavioral_analytics import ClientBehavioralAnalytics

cba = ClientBehavioralAnalytics()
cba.record_event('client1', 'login')
cba.record_event('client1', 'upload')
print(cba.score_clients())
```

