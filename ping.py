import turtle

wn = turtle.Screen()
wn.title("pong by me")
wn.bgcolor('black')
wn.setup(width=800, height=600)
wn.tracer(0)

# Score 

score_a = 0
score_b = 0
# Paddle A
paddle_a = turtle.Turtle()
paddle_a.speed(0)
paddle_a.shape('square')
paddle_a.color('white')
paddle_a.shapesize(stretch_wid=5,stretch_len=1)
paddle_a.penup()
paddle_a.goto(-350,0)
# Paddle B
paddle_b = turtle.Turtle()
paddle_b.speed(0)
paddle_b.shape('square')
paddle_b.color('white')
paddle_b.shapesize(stretch_wid=5,stretch_len=1)
paddle_b.penup()
paddle_b.goto(350,0)
# Ball
ball = turtle.Turtle()
ball.speed(0)
ball.shape('square')
ball.color('white')

ball.penup()
ball.goto(0,0)
ball.dx = -0.2
ball.dy = -0.2


def paddle_a_up():
    y = paddle_a.ycor()
    y +=20
    paddle_a.sety(y)

def paddle_a_down():
    y = paddle_a.ycor()
    y -=20
    paddle_a.sety(y)


def paddle_b_up():
    y = paddle_b.ycor()
    y +=20
    paddle_b.sety(y)

def paddle_b_down():
    y = paddle_b.ycor()
    y -=20
    paddle_b.sety(y)


# Pen

pen = turtle.Turtle()
pen.speed(0)
pen.color('white')
pen.penup()
pen.hideturtle()
pen.goto(0,260)
pen.write(f"Player A : {score_a}     Player B : {score_b}", align="center", font=("Courrier", 24, "bold"))

# Keyboard binding
wn.listen() # liwten to the keyboard
wn.onkeypress(paddle_a_up,"s")
wn.onkeypress(paddle_a_down,"w")
wn.onkeypress(paddle_b_up,"Up")
wn.onkeypress(paddle_b_down,"Down")

# Main game loop
while True:
    wn.update()

    ball.setx(ball.xcor() + ball.dx )
    ball.sety(ball.ycor() + ball.dy )

    # Border checking 
    if ball.ycor() > 290:
        ball.sety(290)
        ball.dy *= -1
    if ball.ycor() < -290:
        ball.sety(-290)
        ball.dy *= -1
    
    if ball.xcor() > 390:
        ball.goto(0,0)
        ball.dx *= -1
        score_a +=1
        pen.clear()
        pen.write(f"Player A : {score_a}     Player B : {score_b}", align="center", font=("Courrier", 24, "bold"))
    if ball.xcor() < -390:
        ball.goto(0,0)
        ball.dx *= -1
        score_b +=1
        pen.clear()
        pen.write(f"Player A : {score_a}     Player B : {score_b}", align="center", font=("Courrier", 24, "bold"))
    
    # paddle and ball collision
    if ball.xcor() > 340 and ball.xcor() < 350 and ball.ycor() < paddle_b.ycor() + 50 and  ball.ycor() > paddle_b.ycor() - 50:
        ball.setx(340)
        ball.dx *= -1
    
    if ball.xcor() < -340 and ball.xcor() > -350 and ball.ycor() < paddle_a.ycor() + 50 and  ball.ycor() > paddle_a.ycor() - 50:
        ball.setx(-340)
        ball.dx *= -1