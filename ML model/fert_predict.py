from flask import Flask, request, jsonify
import numpy as np
import pickle

app = Flask(__name__)

# Load trained model
model = pickle.load(open("model/Fertclassifier.pkl", "rb"))

@app.route('/predict', methods=['POST'])
def predict():
    try:
        # Get JSON data from request
        data = request.get_json()
        print("Received JSON:", data)  # Debugging

        # Expected keys
        required_keys = ['temperature', 'humidity', 'moisture', 
                         'nitrogen', 'potassium', 'phosphorous', 
                         'soil_type', 'crop_type']

        # Validate all required keys
        for key in required_keys:
            if key not in data:
                return jsonify({"error": f"Missing key: {key}"}), 400

        # Convert inputs to numerical format
        features = np.array([[float(data['temperature']), float(data['humidity']), float(data['moisture']),
                              float(data['nitrogen']), float(data['potassium']), float(data['phosphorous']),
                              int(data['soil_type']), int(data['crop_type'])]])
        
        print("Features for prediction:", features)  # Debugging

        # Make prediction
        prediction = model.predict(features)
        print("Prediction:", prediction)  # Debugging

        return jsonify({"prediction": prediction[0]})

    except Exception as e:
        print("Error:", str(e))  # Debugging
        return jsonify({"error": str(e)}), 500

if __name__ == '__main__':
    app.run(debug=True)
