import json
from datetime import datetime
from pathlib import Path
from typing import Dict, List

from .models import Document, Review, Reviewer

DATA_FILE = Path("peer_review_data.json")

class ReviewManager:
    def __init__(self):
        self.documents: Dict[int, Document] = {}
        self.reviewers: Dict[int, Reviewer] = {}
        self.reviews: List[Review] = []
        self._load()

    def _load(self):
        if DATA_FILE.exists():
            with DATA_FILE.open("r", encoding="utf-8") as f:
                data = json.load(f)
            for doc in data.get("documents", []):
                self.documents[doc["id"]] = Document(**doc)
            for rev in data.get("reviewers", []):
                self.reviewers[rev["id"]] = Reviewer(**rev)
            for r in data.get("reviews", []):
                r_obj = Review(
                    document_id=r["document_id"],
                    reviewer_id=r["reviewer_id"],
                    comments=r.get("comments", ""),
                    suggestion=r.get("suggestion"),
                    decision=r.get("decision"),
                    start_time=datetime.fromisoformat(r["start_time"]),
                    end_time=datetime.fromisoformat(r["end_time"]) if r.get("end_time") else None,
                )
                self.reviews.append(r_obj)

    def _save(self):
        data = {
            "documents": [doc.__dict__ for doc in self.documents.values()],
            "reviewers": [rev.__dict__ for rev in self.reviewers.values()],
            "reviews": [
                {
                    **{
                        "document_id": r.document_id,
                        "reviewer_id": r.reviewer_id,
                        "comments": r.comments,
                        "suggestion": r.suggestion,
                        "decision": r.decision,
                        "start_time": r.start_time.isoformat(),
                        "end_time": r.end_time.isoformat() if r.end_time else None,
                    }
                }
                for r in self.reviews
            ],
        }
        with DATA_FILE.open("w", encoding="utf-8") as f:
            json.dump(data, f, indent=2)

    def register_reviewer(self, reviewer: Reviewer):
        self.reviewers[reviewer.id] = reviewer
        self._save()

    def add_document(self, document: Document):
        self.documents[document.id] = document
        self._save()

    def assign_document(self, doc_id: int, reviewer_id: int):
        doc = self.documents[doc_id]
        if reviewer_id not in doc.assigned_reviewers:
            doc.assigned_reviewers.append(reviewer_id)
        doc.status = "under_review"
        self._save()

    def submit_review(
        self, doc_id: int, reviewer_id: int, comments: str, suggestion: str = None, decision: str = None
    ):
        review = Review(document_id=doc_id, reviewer_id=reviewer_id, comments=comments, suggestion=suggestion)
        review.decision = decision
        review.end_time = datetime.utcnow()
        self.reviews.append(review)

        doc = self.documents[doc_id]
        if decision == "approve":
            doc.status = "approved"
        elif decision == "reject":
            doc.status = "rejected"
        self._save()
        return review

    def reviewer_score(self, reviewer_id: int) -> float:
        reviews = [r for r in self.reviews if r.reviewer_id == reviewer_id and r.decision]
        if not reviews:
            return 0.0
        approved = sum(1 for r in reviews if r.decision == "approve")
        return approved / len(reviews)

    def kpi_report(self) -> Dict[str, float]:
        total_reviews = len([r for r in self.reviews if r.decision])
        avg_turnaround = (
            sum(r.turnaround_time() for r in self.reviews if r.turnaround_time()) / total_reviews
            if total_reviews
            else 0.0
        )
        return {
            "total_documents": len(self.documents),
            "total_reviews": total_reviews,
            "avg_turnaround_sec": avg_turnaround,
        }
