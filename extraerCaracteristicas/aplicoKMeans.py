# -*- coding: utf-8 -*-
"""
Created on Sat Oct  4 22:24:21 2014
la funcion se llama así:
python aplicoKMeans.py todasCaracteristicas.csv diccionarioSalida.csv 
@author: juanibraun
"""
import milk
import sys
import csv


input = sys.argv[-2]
out_name = sys.argv[-1]
data = []
i=0
nombres = []

#leo entrada
with open(input,'rb') as g:
    reader = csv.reader(g,delimiter=';')
    for row in reader:
        data.append(row)
                    


#aplico kMeans y genero salida
k = 1000
cluster_ids, centroids = milk.kmeans(data, k)
with open(out_name,'wb') as f:
    writer = csv.writer(f,delimiter=';')
    writer.writerows(centroids)


print cluster_ids
print centroids