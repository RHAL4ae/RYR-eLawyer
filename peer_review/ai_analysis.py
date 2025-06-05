import os
import openai

openai.api_key = os.getenv("OPENAI_API_KEY", "")

PROMPT_TEMPLATE = (
    "Assess the following legal document for quality, completeness, tone, and compliance.\n"
    "Provide a short summary and flag any issues.\n\n{content}\n"
)


def analyze_document(content: str) -> str:
    if not openai.api_key:
        return "OpenAI API key not provided."

    prompt = PROMPT_TEMPLATE.format(content=content)
    response = openai.ChatCompletion.create(
        model="gpt-3.5-turbo",
        messages=[{"role": "user", "content": prompt}],
        max_tokens=200,
    )
    return response.choices[0].message["content"].strip()
