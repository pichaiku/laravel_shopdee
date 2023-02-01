#Import python package
import joblib
import numpy as np
import sys

#Load data

year=int(sys.argv[1])
age=int(sys.argv[2])
distance=int(sys.argv[3])
minimart=int(sys.argv[4])
x=np.array([[year, age, distance, minimart]])
# x = np.array([[2000, 21, 500, 100]])

#load model
path='C:\\xampp\\htdocs\\shoppee\\app\\python\\train_mlp.pkl'
net=joblib.load(path)

#Test Model
y=net.predict(x)
print(round(y[0],2))