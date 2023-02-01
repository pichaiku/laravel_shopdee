#pip install mysql-connector-python
import pandas as pd
from sklearn.neural_network import MLPRegressor
import mysql.connector as sql
import joblib

#X = pd.read_csv("C:\\xampp\\htdocs\\shoppee\\app\\python\\price_house.csv")
conn = sql.connect(host='localhost', database='shopdee', user='root', password='')
query = 'select * from price_house'
X = pd.read_sql(query, conn)

x = X.iloc[:, 1:len(X.columns)-1]
y = X.iloc[:, len(X.columns)-1]

net = MLPRegressor(solver='adam', activation='relu', hidden_layer_sizes=3, max_iter=1000)
net.fit(x,y)

joblib.dump(net, 'C:\\xampp\\htdocs\\shopdee\\app\\python\\train_mlp.pkl')

print('success')