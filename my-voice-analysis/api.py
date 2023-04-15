# import myspsolution as mysp
import pandas as pd
from flask import Flask, render_template, request
from numpy import *
from sklearn import linear_model
import json

mysp=__import__("my-voice-analysis")

app = Flask(__name__)

@app.route("/speakingCheck", methods=["POST", "GET"])

def home():
    data = request.get_json()
    p = data["wav_file_name"] # Audio File title
    c = data["path"]

    results_dict = {}

    results_dict["general"] = mysp.myspsr(p,c)

    ## pronunciation posterior probability
    results_dict["pronunciation"] = mysp.mysppron(p, c)

    ## No of pauses
    results_dict["no of pauses"] = mysp.mysppaus(p, c)

    ## rate of speech
    results_dict["rate of speech"] = mysp.myspsr(p, c)

    ## articulation rate
    results_dict["articulation rate"] = mysp.myspatc(p, c)

    result = {
            'communicationskills': results_dict
        }

    return json.dumps(result)


if __name__ == "__main__":

    # use 0.0.0.0 for replit hosting
    app.run(host="0.0.0.0", port=8081)
