import textstat
import numpy as np
import pandas as pd 
import matplotlib.pyplot as plt
import json

from flask_restful import Resource, Api
from flask import Flask, request, jsonify


app = Flask(__name__)

# @app.route('/foo', methods=['POST']) 
# def foo():
#     data = request.json
    # return jsonify(data)

@app.route('/AnalyzeText', methods=['POST'])
def AnalyzeText():
    text_data = request.get_json()
    text_data = text_data['text']
    flesch_reading_ease = textstat.flesch_reading_ease(text_data)
    flesch_kincaid_grade = textstat.flesch_kincaid_grade(text_data)
    smog_index = textstat.smog_index(text_data)
    coleman_liau_index = textstat.coleman_liau_index(text_data)
    automated_readability_index = textstat.automated_readability_index(text_data)
    dale_chall_readability_score = textstat.dale_chall_readability_score(text_data)
    difficult_words = textstat.difficult_words(text_data)
    linsear_write_formula = textstat.linsear_write_formula(text_data)
    gunning_fog = textstat.gunning_fog(text_data)
    text_standard = textstat.text_standard(text_data)
    fernandez_huerta = textstat.fernandez_huerta(text_data)
    szigriszt_pazos = textstat.szigriszt_pazos(text_data)
    gutierrez_polini = textstat.gutierrez_polini(text_data)
    crawford =  textstat.crawford(text_data)
    gulpease_index = textstat.gulpease_index(text_data)
    osman = textstat.osman(text_data)
    
    dictData = {
        "flesch_reading_ease": flesch_reading_ease,
        "flesch_kincaid_grade": flesch_kincaid_grade,
        "smog_index": smog_index,
        "coleman_liau_index": coleman_liau_index,
        "automated_readability_index":automated_readability_index,
        "dale_chall_readability_score":dale_chall_readability_score,
        "difficult_words":difficult_words,
        "linsear_write_formula":linsear_write_formula,
        "gunning_fog":gunning_fog,
        "text_standard":text_standard,
        "fernandez_huerta":fernandez_huerta,
        "szigriszt_pazos":szigriszt_pazos,
        "gutierrez_polini":gutierrez_polini,
        "crawford": crawford,
        "gulpease_index":gulpease_index,
        "osman":osman,
        
    }
    # return jsonify(text_data)
    return json.dumps(dictData, indent=1)


if __name__ == '__main__':
    app.run(port=8001)
    


