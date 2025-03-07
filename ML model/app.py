from flask import Flask, request, jsonify
import pickle
import numpy as np
import os

app = Flask(__name__)

# Path to model directory
MODEL_DIR = "model"

# Load models dynamically
models = {}
for filename in os.listdir(MODEL_DIR):
    if filename.endswith(".pkl"):
        model_name = filename.split(".")[0]  # Extract model name (e.g., "SVMClassifier")
        with open(os.path.join(MODEL_DIR, filename), "rb") as f:
            models[model_name] = pickle.load(f)

@app.route("/")
def home():
    return "Crop Prediction API is running!"

@app.route("/predict", methods=["POST"])
def predict():
    try:
        data = request.json
        features = np.array([
            [
                data["nitrogen"],
                data["phosphorous"],
                data["potassium"],
                data["ph"],
                data["temperature"],
                data["humidity"],
                data["rainfall"]
            ]
        ])
        
        # Use default model (SVMClassifier)
        selected_model = models.get("RandomForest", None)
        if selected_model is None:
            return jsonify({"error": "RandomForest.pkl not found"}), 500

        prediction = selected_model.predict(features)
        return jsonify({"prediction": prediction[0]})
    
    except Exception as e:
        return jsonify({"error": str(e)}), 500

if __name__ == "__main__":
    app.run(debug=True, port=5002)
