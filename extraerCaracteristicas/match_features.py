def match_features(dicc_csv, name):

    #dicc_csv = nombre del archivo dicc
    #name = nombre de la imagen
    
    import numpy as np
    import cv2
    import csv
   
    #leo diccionario
    reader=csv.reader(open(dicc_csv,"rb"),delimiter=';')
    x=list(reader)
    dicc=np.array(x)
    dicc=np.float32(dicc)

    #abro imagen   
    img = cv2.imread(name,0)    
    #aplico Surf
    surf = cv2.SURF(500)
    surf.extended = False
    kp, des = surf.detectAndCompute(img,None)
    des=np.float32(des)
    
    #genero el objeto matcher y hago el matcheo
    bf = cv2.BFMatcher()
    matches = bf.knnMatch(des,dicc, k=2)    
    
   # Elijo por distancia
    match = []
    for m,n in matches:
        if m.distance < 0.75*n.distance:
            match.append([m.trainIdx, m.queryIdx])
            print m.trainIdx, m.queryIdx
    
    
    
 
import sys

#leo parametros de entrada
#la funcion se llama asi:
#python match_features.py nombreImg.jpg dicc.csv 
img_name = sys.argv[-2]
dicc = sys.argv[-1]
    
match_features(dicc, img_name)
    

