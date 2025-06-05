import sys
from pathlib import Path
sys.path.insert(0, str(Path(__file__).resolve().parents[1]))

from analysis import sentiment_tone


def test_module_import():
    assert hasattr(sentiment_tone, 'ToneAnalyzer')
