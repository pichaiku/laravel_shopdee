#Import python package
import joblib
import numpy as np
import sys
import warnings
warnings.filterwarnings("ignore")

#Receive data
year=int(sys.argv[1]) 
age=int(sys.argv[2]) #In term of year
distance=int(sys.argv[3]) #In term of meter
minimart=int(sys.argv[4])
x=np.array([[year, age, distance, minimart]])
# x = np.array([[2000, 21, 500, 5]])

#Load model
path='C:\\xampp\\htdocs\\shopdee\\app\\python\\house_price_model.pkl'
net=joblib.load(path)

#Test Model
y=net.predict(x)
print(round(y[0],2))