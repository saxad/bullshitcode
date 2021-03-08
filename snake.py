""" jeu de snake bidon"""

import curses
import time
import random


stdscr = curses.initscr()

#game structure
snake = [(2,2),(2,3),(2,4)]
food = (9,48)
head = [2,4]
score = 0


# window settings
width = 60
height = 20


curses.curs_set(0)
curses.cbreak()
curses.noecho()
window = curses.newwin(height, width, 0, 0)
window.keypad(1)
window.nodelay(1)
window.border(124,124,45,45,43,43,43,43)
window.addstr(0,0, "*** scrore : {}   ***".format(score))
window.refresh()
time.sleep(0.5)

## game structure
window.addch(snake[0][0],snake[0][1],'#')
window.addch(snake[1][0],snake[1][1],'#')
window.addch(snake[2][0],snake[2][1],'#')
window.addch(food[0],food[1],'*')
window.refresh()

key = curses.KEY_RIGHT
ESC = 27
while key != ESC:

    prevkey = key 
    event = window.getch() 
    key =  key if event == -1 else event

    #si snake mange food ; generer un autre food
    if snake[-1] == food:
        snake.append(food)
        head[0] = food[0]
        head[1] = food[1]
        food = ()

        window.addch(head[0],head[1],'#')
        insnake = True
        while food == ():
            food = (random.randint(1,18), random.randint(1,58))
            if food in snake:
                food = ()
        window.addch(food[0],food[1],'*')
        score +=1
        window.addstr(0,0, "*** scrore : {}   ***".format(score ))
        window.refresh()

    if key == curses.KEY_LEFT:
        head[1] -= 1
        snake.append((head[0],head[1]))
        tail = snake.pop(0)
        window.addch(tail[0],tail[1],' ')
        window.addch(head[0],head[1],'#')
        #window.addch(y,x,'R')
        window.refresh()
        time.sleep(0.3)
    elif key == curses.KEY_RIGHT:
        head[1] += 1
        snake.append((head[0],head[1]))
        tail = snake.pop(0)
        window.addch(tail[0],tail[1],' ')
        window.addch(head[0],head[1],'#')
        window.refresh()
        time.sleep(0.3)
    elif key == curses.KEY_DOWN:
        head[0] += 1
        snake.append((head[0],head[1]))
        tail = snake.pop(0)
        window.addch(tail[0],tail[1],' ')
        window.addch(head[0],head[1],'#')
        #window.addch(y,x,'R')
        window.refresh()
        time.sleep(0.3)
    elif key == curses.KEY_UP:
        head[0] -= 1
        snake.append((head[0],head[1]))
        tail = snake.pop(0)
        window.addch(tail[0],tail[1],' ')
        window.addch(head[0],head[1],'#')
        #window.addch(y,x,'R')
        window.refresh()
        time.sleep(0.3)
    elif key == curses.KEY_EXIT:
        window.addch(6,6,'E')
        window.refresh()
        time.sleep(0.1)




curses.nocbreak()
stdscr.keypad(False)
curses.echo()
curses.endwin()