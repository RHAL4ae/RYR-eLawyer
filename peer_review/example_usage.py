from .review_manager import ReviewManager
from .models import Document, Reviewer
from .ai_analysis import analyze_document

if __name__ == "__main__":
    manager = ReviewManager()

    # Register reviewers
    reviewer = Reviewer(id=1, name="Alice")
    manager.register_reviewer(reviewer)

    # Add a document
    doc = Document(id=1, title="Contract A", content="Sample contract text.")
    manager.add_document(doc)

    # Assign document
    manager.assign_document(doc_id=1, reviewer_id=1)

    # AI analysis
    print("AI Analysis:\n", analyze_document(doc.content))

    # Reviewer submits review
    review = manager.submit_review(
        doc_id=1,
        reviewer_id=1,
        comments="Looks good",
        suggestion="Consider revising clause 2",
        decision="approve",
    )
    print("Review submitted with turnaround time:", review.turnaround_time())
    print("KPI report:", manager.kpi_report())
