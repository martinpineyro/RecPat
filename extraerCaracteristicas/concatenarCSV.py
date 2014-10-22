# -*- coding: utf-8 -*-
"""
Created on Sat Oct  4 17:57:24 2014

@author: juanibraun
"""

import os, os.path
import sys
import csv
import arff
import string

path = sys.argv[-2]
out_name = sys.argv[-1]
arff_name = string.replace(out_name,'csv','arff')
data = []
i=0
nombres = []
for i in range(0,64):
    nombres.append((str(i+1),'REAL'))
print nombres

print path

with open(out_name,'wb') as f:
        writer = csv.writer(f,delimiter=';')
        for file in os.listdir(path):
            current_file = os.path.join(path, file)
            #print current_file                
            with open(current_file,'rb') as g:
                reader = csv.reader(g,delimiter=';')
                for row in reader:
                    data.append(row)
                    writer.writerow(row)

salida = {'description':"Features de todas las imagenes",
          'relation':"features",
          'attributes':nombres,
          'data':data}
arff.dump(salida, open(arff_name, 'w'))
                    
                    

    