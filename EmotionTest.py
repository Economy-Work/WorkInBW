from fer import FER
import cv2
import os
from scipy.stats import mode

def videoEmotion(dir):
    emotionResult = []
    for item in os.listdir(dir):
        image_path = dir + item
        img = cv2.imread(image_path)
        detector = FER()
        emotion, score = detector.top_emotion(img)
        # print(emotion, score)
        emotionResult.append(emotion)
        # print(emotionResult)
    # print(emotionResult)
    return mode(emotionResult)
    

dir = 'EmotionTestData/'
emotion = videoEmotion(dir)
print(emotion)