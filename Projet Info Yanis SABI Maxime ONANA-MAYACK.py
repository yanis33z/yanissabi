import random

def display_map(m,d):
    lignes = len(m)
    colonnes = len(m[0])
    l = [[] for i in range(lignes)]
    
    for i in range(lignes) :
        for j in range(colonnes) :
            l[i].append((d[m[i][j]]))
    for i in l :
        print("".join(i))
      
    return

def generate_random_map(taille,prop):
    k,l= taille[0],taille[1]
    map = [[0 for i in range(l)] for j in range(k)]
    
    if prop > 1 :
        print("impossible")
        return
    for i in range(int(k*l*prop)):
        x,y = random.randint(0,k-1),random.randint(0,l-1)
        if (x,y) != (0,0) : map[x][y] = random.randint(1,2)
    return map
  
map = generate_random_map((random.randint(3,20),random.randint(3,20)),0.3)
dico = {0:' ',1:'#',2:'█'}



def create_perso(char,x,y,score):
    d={}
    d[char],d["x"],d["y"],d['score']=char,x,y,0
    return d
print(create_perso("o",0,0,0))


def display_map_and_char(m,d,p):
    lignes = len(m)
    colonnes = len(m[0])
    l = [[] for i in range(lignes)]
    
    for i in range(lignes) :
        for j in range(colonnes) :
            l[i].append((d[m[i][j]]))
    l[-p['y']][p['x']]=p['char']
    for i in l:
        print("".join(i))
perso={'char':'o','x':0,'y':0,'score':0}



def update_p(str,p,m) :
    py,px=p['y'],p['x']
    if str not in {'z','q','s','d','e'} : print("recommencer")
    if str == "e" : delete_all_walls(m,p)
    if str == "z" :
        if m[-py-1][px] == 1 or m[-py-1][px]==2:
            py =py
        else :
            py+=1
    
    if str == "s" :
        
        if -py < len(m)-1 and m[-py+1][px] == 1 :
            py =py
        elif -py < len(m)-1 and m[-py+1][px] == 2 :
            py =py
        else :
            py-=1
    
    
    if str == "q" :
        if m[-py][px-1] == 1 or m[-py][px-1] == 2:
            px=px
        else :
            px -=1
        
    
    if str == "d" :
        if px<len(m[0])-1 and  m[-py][px+1] == 1 :
            px = px
        elif px<len(m[0])-1 and  m[-py][px+1] == 2 :
            px = px
        else :
            px += 1
    if 0 >= py > -len(map) and 0 <= px < len(map[0]):
        p['x'], p['y'] = px, py


    print(p)


n = random.randint(0,10)
def create_objects(n,m) :
    h = set()
    x = 0
    y = 0
    for i in range(n) :
        x,y = random.randint(0,len(m[0])-1),random.randint(0,len(m)-1)
        if m[y][x] == 0 and (x,y) != (0,0) :
            h.add((x,y))
    return h

def display_map_char_and_objects_and_mines(m,p,d,objects,mines):
    lignes = len(m)
    colonnes = len(m[0])
    l = [[] for i in range(lignes)]
    
    for i in range(lignes) :
        for j in range(colonnes) :  
            l[i].append((d[m[i][j]]))
            
    l[-p['y']][p['x']] = p['char']
    for i in objects :
        l[i[1]][i[0]] = "*"
    for i in mines :
        l[i[1]][i[0]] = "M"

    for i in l :
        print("".join(i))
    
    print("Score : ", p["score"])
    

def create_mines(n,m):
    return create_objects(n,m)


objects=create_objects(random.randint(5,int(len(map)*len(map[0])/5)),map)
mines = create_mines(random.randint(1,int(len(map)*len(map[0])/5)),map)
for i in objects:
    if i in mines:
        mines.remove(i)
display_map_char_and_objects_and_mines(map,perso,dico,objects,mines)
k=len(objects)

def update_objects(p,objects):
    s=objects.copy()
    for i in s:
        if i[0]==p['x'] and i[1]==-p['y']:
            objects.remove(i)
            p['score']+=1

def delete_all_walls(map, p):
    if -p['y'] < len(map)-1 and p['x'] < len(map[0]) - 1 :
        for i in range((-p['y']-1),(-p['y']+2)):
            for j in range((p['x']-1),(p['x']+2)):
                if map[i][j] == 1 :
                    map[i][j]=0
    if -p['y'] == len(map)-1 and p['x'] < len(map[0]) - 1 :
        for i in range(-p['y']-1,-p['y']+1):
            for j in range((p['x']-1),(p['x']+2)):
                if map[i][j] == 1 or map[i][j]==0:
                    map[i][j]=0


while perso['score']!=k:
    e=input()
    update_p(e,perso,map)
    update_objects(perso,objects)
    display_map_char_and_objects_and_mines(map,perso,dico,objects,mines)
    if (perso['x'],-perso['y']) in mines:
        perso['y'],perso['x']=0,0
        perso['score']=0
        objects=create_objects(random.randint(5,int(len(map)*len(map[0])/5)),map)
        print("Appuyez sur entrer pour rejouer")
print("VICTOIRE!")
    
    
    
    
    
















