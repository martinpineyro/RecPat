def extraerCaracteristica(name, factor):

    import numpy as np
    import cv2
    import csv
    import string
    #abro imagen y la muestro
    print name    
    img = cv2.imread(name,0)
    #cv2.imshow('Demo',img)
    height,width = img.shape
    
    # creo archivo para guardar descriptores
    out_name = string.replace(name,'jpg','csv')
   
    #print out_name
    with open(out_name,'wb') as f:
        writer = csv.writer(f,delimiter=';')
        #arranco a recorrer por bloques
        for i in range(0, factor):
            for j in range(0, factor):
                #elijo bloque de la imagen
                aux=img[i*height/factor:i*height/factor+height/factor-1,j*width/factor:j*width/factor+width/factor-1]
 
            	"""
            	#muestro bloque
            	cv2.imshow('Demo2',aux)
            	k=cv2.waitKey(0)
            	if k == ord('c'):
            	cv2.destroyWindow('Demo2')
            	"""
            		
            		    	# SURF 
            	surf = cv2.SURF(500)
            	surf.extended = False
            	kp, descritors = surf.detectAndCompute(aux,None)
            	if descritors != None:
                    	writer.writerow(['bloque',i*factor+j,'numero descriptores', len(descritors)])                
                    	writer.writerows(descritors)
   
import os
import sys

#leo parametros de entrada
path = sys.argv[-2]
factor = sys.argv[-1]
factor = int(factor)

for file in os.listdir(path):
    current_file = os.path.join(path, file)
    print current_file
    extraerCaracteristica(current_file, factor)
    





