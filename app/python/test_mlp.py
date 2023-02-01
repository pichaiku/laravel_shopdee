import joblib
import numpy as np
import sys

year = int(sys.argv[1])
age = int(sys.argv[2])
distance = int(sys.argv[3])
minimart = int(sys.argv[4])
x = np.array([[year,age,distance,minimart]])
#x = np.array([[2000,21,500,7]])

net = joblib.load('C:\\xampp\\htdocs\\shopdee\\app\\python\\train_mlp.pkl')
y = net.predict(x)

print(round(y[0],2))