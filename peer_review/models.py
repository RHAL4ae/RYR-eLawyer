from dataclasses import dataclass, field
from datetime import datetime
from typing import List, Optional

@dataclass
class Reviewer:
    id: int
    name: str
    score: float = 0.0
    review_history: List[int] = field(default_factory=list)

@dataclass
class Document:
    id: int
    title: str
    content: str
    assigned_reviewers: List[int] = field(default_factory=list)
    status: str = "pending"  # pending, under_review, approved, rejected

@dataclass
class Review:
    document_id: int
    reviewer_id: int
    comments: str = ""
    suggestion: Optional[str] = None
    decision: Optional[str] = None  # approve or reject
    start_time: datetime = field(default_factory=datetime.utcnow)
    end_time: Optional[datetime] = None

    def turnaround_time(self) -> Optional[float]:
        if self.end_time:
            return (self.end_time - self.start_time).total_seconds()
        return None
