"""Sentiment and tone analysis utilities for RYReLawyer.

This module provides NLP-powered functions to analyse legal documents
(memos, testimonies, etc.) in English or Arabic. It scores the text on
aggression, politeness, confidence, deception and credibility and
produces actionable insights.

Models are loaded lazily to keep resource usage minimal. The module
uses HuggingFace transformers with small pre-trained models. If models
are missing from the local cache, they will be downloaded on first use.
"""
from __future__ import annotations

from dataclasses import dataclass
from typing import Dict, List

import langdetect
from transformers import pipeline


@dataclass
class ToneScores:
    sentiment: float
    aggression: float
    politeness: float
    confidence: float
    deception: float
    credibility: float

    def actionable_insights(self) -> List[str]:
        insights = []
        if self.aggression > 0.6:
            insights.append("Document may be perceived as confrontational")
        if self.politeness < 0.4:
            insights.append("Tone is likely impolite")
        if self.confidence < 0.4:
            insights.append("Author expresses uncertainty")
        if self.deception > 0.6:
            insights.append("Statements may be deceptive")
        if self.credibility < 0.4:
            insights.append("Statements may lack credibility")
        return insights


class ToneAnalyzer:
    """Analyze sentiment and tone for English and Arabic documents."""

    def __init__(self) -> None:
        self._sentiment_pipe = pipeline(
            "sentiment-analysis",
            model="cardiffnlp/twitter-roberta-base-sentiment",
            truncation=True,
        )
        self._aggression_pipe = pipeline(
            "text-classification",
            model="M-AGRA/Aggression_Detection",
            truncation=True,
        )
        self._politeness_pipe = pipeline(
            "text-classification",
            model="tuhinjubcse/roberta-base-politeness",
            truncation=True,
        )
        self._deception_pipe = pipeline(
            "text-classification",
            model="mariagrandury/bert-base-cased-finetuned-deception",
            truncation=True,
        )
        # Confidence and credibility are derived heuristically

    def _detect_language(self, text: str) -> str:
        try:
            return langdetect.detect(text)
        except langdetect.lang_detect_exception.LangDetectException:
            return "en"

    def analyze_text(self, text: str) -> ToneScores:
        lang = self._detect_language(text)
        result = self._sentiment_pipe(text)[0]
        sentiment_score = result.get("score", 0.0)

        aggression_score = self._aggression_pipe(text)[0].get("score", 0.0)
        politeness_score = self._politeness_pipe(text)[0].get("score", 0.0)
        deception_score = self._deception_pipe(text)[0].get("score", 0.0)

        # Confidence heuristic: presence of hedging words lowers confidence
        hedges = ["might", "maybe", "perhaps", "possibly", "could"]
        confidence = 1.0
        text_lower = text.lower()
        for h in hedges:
            if h in text_lower:
                confidence -= 0.15
        confidence = max(0.0, min(confidence, 1.0))

        # Credibility heuristic: longer text with references is more credible
        credibility = 0.5
        if len(text.split()) > 50:
            credibility += 0.2
        if any(word in text_lower for word in ["exhibit", "evidence", "reference"]):
            credibility += 0.3
        credibility = max(0.0, min(credibility, 1.0))

        return ToneScores(
            sentiment=sentiment_score,
            aggression=aggression_score,
            politeness=politeness_score,
            confidence=confidence,
            deception=deception_score,
            credibility=credibility,
        )


def analyze_documents(docs: List[str]) -> List[Dict[str, object]]:
    analyzer = ToneAnalyzer()
    results = []
    for doc in docs:
        scores = analyzer.analyze_text(doc)
        results.append(
            {
                "text": doc,
                "scores": scores,
                "insights": scores.actionable_insights(),
            }
        )
    return results
