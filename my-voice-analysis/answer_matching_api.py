from sentence_transformers import SentenceTransformer, util
import pandas as pd
from flask import Flask, render_template, request
from numpy import *
import json

#####################################################

app = Flask(__name__)


@app.route("/answerSimilarityCheck", methods=["POST", "GET"])
def home():
    model = SentenceTransformer('distilbert-base-nli-mean-tokens')

    data = request.get_json()
    user_answer_list = data["user_answer_list"]
    ground_truth_list = data["ground_truth_list"] 


    user_embeddings = model.encode(user_answer_list)
    ground_truth_embeddings = model.encode(ground_truth_list)

    results = []
    for i in range(len(user_embeddings)):
        results.append(util.pytorch_cos_sim(user_embeddings[i], ground_truth_embeddings[i]).numpy()[0][0])

    print(results)
    results = {"eachquesresult": results, "aggresult": mean(results)}

    return json.dumps(str(results))

if __name__ == "__main__":

    # use 0.0.0.0 for replit hosting
    app.run(host="0.0.0.0", port=8082)