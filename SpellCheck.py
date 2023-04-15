from gingerit.gingerit import GingerIt
from flask import Flask, request
import json

app = Flask(__name__)

@app.route('/spellGrammarCheck', methods=['POST'])
def spellGrammarCheck():
    text_data = request.get_json()
    text = text_data['text']
    
    totalWords = len(text.split())
    parser = GingerIt()
    result = parser.parse(text)

    errors = len(result['corrections'])

    percentageError = (errors/totalWords)*100
    correctness = 100 - percentageError
    print(percentageError, correctness)
    result = {
        'percentageError': percentageError,
        'correctness': correctness
    }
    return json.dumps(result, indent=1)

if __name__ == '__main__':
    app.run(port=8002)
    