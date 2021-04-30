import pickle
from sklearn.preprocessing import LabelEncoder
from sklearn.svm import SVC
from src.config import config


def train_model():
    print("run training...")
    data = pickle.loads(open(config['DEFAULT']['EmbeddingsFile'], "rb").read())

    print("[INFO] encoding labels...")
    le = LabelEncoder()
    labels = le.fit_transform(data["names"])


    print("[INFO] training model...")
    recognizer = SVC(C=1.0, kernel="linear", probability=True)
    recognizer.fit(data["embeddings"], labels)


    f = open(config['DEFAULT']['RecognizerFile'], "wb")
    f.write(pickle.dumps(recognizer))
    f.close()

    f = open(config['DEFAULT']['LeFile'], "wb")
    f.write(pickle.dumps(le))
    f.close()
    print("end training....")