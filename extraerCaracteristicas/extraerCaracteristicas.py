import numpy as np
import cv2
import sys
import csv


#leo parametros de entrada
filename = sys.argv[-2]
factor = sys.argv[-1]
factor = int(factor)

#abro imagen y la muestro
img = cv2.imread(filename,0)
#cv2.imshow('Demo',img)
height,width = img.shape

# creo archivo para guardar descriptores
out = 
with open('out.csv', 'wb') as f:
    writer = csv.writer(f,delimiter=';')
    #arranco a recorrer por bloques
    for i in range(0, factor):
        for j in range(0, factor):
            print i,j
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
                print len(descritors)                
                writer.writerows(descritors)
           
    
        

def cerrarVentana():
    cv2.destroyAllWindows()
    sys.exit()



