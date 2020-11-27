using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Threading;
using System.Windows.Forms;
using System.Diagnostics;
using System.IO;

namespace MultiForm
{
    public partial class Form2 : Form
    {
        public class Canvas
        {
            public int width = 846;
            public int height = 659;
        }
        Canvas mycanvas=new Canvas();
        public class Game
        {
            public int boardsize = 20;
            public bool move = false;
            public bool movemouse = false;
            public int level = 1200;
            public int money = 0;
            public int timepass = 0;
            public int counttime = 0;
            public bool gameover = false;
        }
        Game game = new Game();
        public class Player
        {
            public string name;
            public string[] players = new string[5];
            public string[] scores = new string[5];
            public float x = -50, y = -50;
            public float newex = 0, newey = 0;
            public float r = 5;
        }
        Player player = new Player();
        public class Monsters
        {
            public float dx = 0, dy = 0, esp = 3, er = 15;
            public float[] monstx_list = new float[20];
            public float[] monsty_list = new float[20];
            public float[] monstz_list = new float[20];
        }
        Monsters monsters = new Monsters();
        public class Plays
        {
            public float playx = 0;
            public float playy = 0;
            public bool play = false;
            public float playr = 10;
        }
        Plays Shrink = new Plays();
        Plays speed = new Plays();
        Plays All = new Plays();
        Plays Revive = new Plays();
        Plays Pmoney = new Plays();
        Random ran = new Random();
        public Form2() : base()
        {
            InitializeComponent();
            MaximizeBox = false;
            button3.Visible = false;
            button4.Visible = false;
            button5.Visible = false;
            button6.Visible = false;
            Form4 f = new Form4();
            f.Visible = false;
        }
        private void button1_Click(object sender, EventArgs e)
        {
            Form1 f = new Form1();
            this.Visible = false;
            f.Visible = true;
        }
        Graphics canvas;
        bool box = false;
        bool entername = false;
        public void Form2_Load(object sender, EventArgs e)
        {
            canvas = CreateGraphics();
            timer1 = new System.Windows.Forms.Timer();
            timer1.Tick += new EventHandler(timer1_Tick);
            timer1.Interval = game.level / 60;
            timer1.Start();
            timer2.Interval = 500;
            timer2.Start();
            timer3.Interval = 1000;
            timer3.Start();
            timer6.Interval = 5;
            timer6.Start();
        }
        private void button2_Click(object sender, EventArgs e)
        {
            game.move = true;
            game.movemouse = true;
            button2.Visible = false;
        }
        private void timer2_Tick(object sender, EventArgs e)
        {
            if (game.move) CreateMonster(monsters.er);
        }
        private void Form2_MouseMove(object sender, MouseEventArgs e)
        {
            if (game.movemouse)
            {
                player.x = e.X - player.r;
                player.y = e.Y - player.r;
            }
        }
        bool explosion = false;
        private void timer1_Tick(object sender, EventArgs e)
        {
            if(Pmoney.play==true)
            {
                SolidBrush test = new SolidBrush(Color.Yellow);
                canvas.FillEllipse(test, Pmoney.playx, Pmoney.playy, Pmoney.playr*2, Pmoney.playr*2);
                if (collision(Pmoney.playx,Pmoney.playy,player.x,player.y,player.r,Pmoney.playr))
                {
                    SolidBrush refreshcolor = new SolidBrush(Color.Gray);
                    canvas.FillEllipse(refreshcolor, Pmoney.playx, Pmoney.playy, Pmoney.playr * 2, Pmoney.playr * 2);
                    Pmoney.play = false;
                    game.money += 1;
                    SolidBrush cleanmoney = new SolidBrush(Color.Gray);
                    canvas.FillRectangle(cleanmoney, 543, 15, 30, 30);

                }
            }
            if(game.money>=1)
            {
                button3.Visible = true;
            }
            else
            {
                button3.Visible = false;
            }
            if(game.money>=5)
            {
                button4.Visible = true;
            }
            else
            {
                button4.Visible = false;
            }
            if(game.money>=10)
            {
                button5.Visible = true;
            }
            else
            {
                button5.Visible = false;
            }
            if(game.money>=15)
            {
                button6.Visible = true;
            }
            else
            {
                button6.Visible = false;
            }
            if(Shrink.play == true)
            {
                SolidBrush backclean = new SolidBrush(Color.Gray);
                canvas.FillRectangle(backclean, 0, 0, mycanvas.width, mycanvas.height);
                monsters.er = 5;
                if(game.counttime>=5)
                {
                    monsters.er = 15;
                    Shrink.play = false;
                    game.counttime = 0;
                }
            }
            if (speed.play == true)
            {
                SolidBrush m = new SolidBrush(Color.White);
                canvas.FillEllipse(m, 0, 0, 20, 20);
                SolidBrush playcolor = new SolidBrush(Color.White);
                canvas.FillEllipse(playcolor, speed.playx, speed.playy, speed.playr * 2, speed.playr * 2);
                    speed.play = false;
                    SolidBrush refreshcolor = new SolidBrush(Color.Gray);
                    canvas.FillEllipse(refreshcolor, speed.playx, speed.playy, speed.playr * 2, speed.playr * 2);
                    explosion = true;
                    while (explosion)
                    {
                        for (int j = 0; j < 100; j++)
                        {
                            for (int i = 0; i < game.boardsize; i++)
                            {
                                game.move = false;
                                if (monsters.monstz_list[i] != 0)
                                {
                                    SolidBrush refreshBrush = new SolidBrush(Color.Gray);
                                    canvas.FillEllipse(refreshBrush, monsters.monstx_list[i], monsters.monsty_list[i], monsters.er * 2, monsters.er * 2);
                                    const float slow = 1;
                                    SolidBrush pausecolar = new SolidBrush(Color.White);
                                    monsters.dx = player.x + player.r - monsters.monstx_list[i] - monsters.er;
                                    monsters.dy = player.y + player.r - monsters.monsty_list[i] - monsters.er;
                                    float L = (float)Math.Sqrt(monsters.dx * monsters.dx + monsters.dy * monsters.dy);
                                monsters.monstx_list[i] = monsters.monstx_list[i] + monsters.dx / L * slow;
                                monsters.monsty_list[i] = monsters.monsty_list[i] + monsters.dy / L * slow;
                                    canvas.FillEllipse(pausecolar, monsters.monstx_list[i], monsters.monsty_list[i], monsters.er * 2, monsters.er * 2);
                                }
                            }
                            game.move = true;
                            explosion = false;
                        }
                    }
            }
            if (All.play == true)
            {
                SolidBrush refreshcolor = new SolidBrush(Color.Black);
                canvas.FillEllipse(refreshcolor, All.playx, All.playy, All.playr * 2, All.playr * 2);
                All.play = false;
                for (int i = 0; i < 100; i++)
                {
                    DrawRectangle(8 * i, 0, 8 * (i - 1), 0);
                    for (int j = 0; j < game.boardsize; j++)
                    {
                        if (monsters.monstz_list[j] != 0)
                        {
                            if (EllipseAll(8 * i, monsters.monstx_list[j])) monsters.monstz_list[j] = 0;
                        }
                    }
                }
            }
            draw();
            monstcollision();
        }
        private void DrawRectangle(int x1,int y1,int x2,int y2)
        {
            SolidBrush eraser = new SolidBrush(Color.Blue);
            canvas.FillRectangle(eraser, x1, y1, 50, 659);
            SolidBrush clear = new SolidBrush(Color.Gray);
            canvas.FillRectangle(clear, x2, y2, 50, 659);
        }
        private bool EllipseAll (int x1, float x2)
        {
            if (x2 <= x1) return true;
            else return false;
        }
        private void timer3_Tick(object sender, EventArgs e)
        {
            if(game.movemouse)game.timepass += 1;
            createmoney();
            if (Shrink.play == true)
            {
                game.counttime += 1;
            }
            SolidBrush mySolidBrush = new SolidBrush(Color.Gray);
            canvas.FillRectangle(mySolidBrush, 63, 15, 30, 30);
        }
        private void harder(int timepass)
        {
            monsters.esp += (float)timepass / 2;
        }
        public bool collision(float objx1, float objy1, float objx2, float objy2, float r, float er)
        {
            float dist = (float)Math.Sqrt((objx1 + er - objx2 - r) * (objx1 + er - objx2 - r) + (objy1 + er - objy2 - r) * (objy1 + er - objy2 - r));
            if (dist <= r + er) return true;
            else return false;
        }
        int addball = 0;
        private void Form2_KeyDown(object sender, KeyEventArgs e)
        {
            switch(e.KeyCode)
            {
                case Keys.Z:
                    {
                        if(button3.Visible==true)
                        {
                            Shrink.play = true;
                            game.money -= 1;
                        }
                    }
                    break;
                case Keys.X:
                    {
                        if(button4.Visible==true)
                        {
                            speed.play = true;
                            game.money -= 5;
                        }

                    }
                    break;
                case Keys.C:
                    {
                        if(button5.Visible==true)
                        {
                            All.play = true;
                            game.money -= 10;
                        }
                    }
                    break;
            }
        }
        public void CreateMonster(float er)
        {
            if (monsters.monstz_list[addball] == 0)
            {
                player.newex = ran.Next(0, mycanvas.width);
                player.newey = ran.Next(0, mycanvas.height);
                if ((player.newex - player.x) * (player.newex - player.x) + (player.newey - player.y) * (player.newey - player.y) >= 20)
                {
                    monsters.monstx_list[addball] = player.newex;
                    monsters.monsty_list[addball] = player.newey;
                    monsters.monstz_list[addball] = 1;
                    SolidBrush myBrush;
                    if (addball % 5 == 0)
                    {
                        myBrush = new SolidBrush(Color.Red);
                    }
                    else if (addball % 3 == 0)
                    {
                        myBrush = new SolidBrush(Color.Yellow);
                    }
                    else if (addball % 2 == 0)
                    {
                        myBrush = new SolidBrush(Color.LightGreen);
                    }
                    else
                    {
                        myBrush = new SolidBrush(Color.SkyBlue);
                    }
                    canvas.FillEllipse(myBrush, player.newex, player.newey, er * 2, er * 2);
                }
            }
            if (addball == game.boardsize - 1) addball = 0;
            else addball += 1;
        }
        private void monstcollision()
        {
            for (int i = 0; i < game.boardsize; i++)
            {
                for (int j = 0; j < game.boardsize; j++)
                {
                    if (i != j)
                    {
                        if (monsters.monstz_list[i] != 0 && monsters.monstz_list[j] != 0)
                        {
                            if (collision(monsters.monstx_list[i], monsters.monsty_list[i], monsters.monstx_list[j], monsters.monsty_list[j], monsters.er, monsters.er))
                            {
                                monsters.monstz_list[i] = 0;
                                SolidBrush refreshbrush = new SolidBrush(Color.Gray);
                                canvas.FillEllipse(refreshbrush, monsters.monstx_list[i], monsters.monsty_list[i], monsters.er * 2, monsters.er * 2);
                            }
                        }
                    }
                }
            }
        }
        private void timer6_Tick(object sender, EventArgs e)
        {
            for (int i = 0; i < game.boardsize; i++)
            {
                if (monsters.monstz_list[i] != 0 && player.x != -50 && player.y != -50)
                {
                    if (collision(monsters.monstx_list[i], monsters.monsty_list[i], player.x, player.y, player.r, monsters.er))
                    {
                        if (game.money >= 15)
                        {
                            if (box==false)
                            {
                                box = true;
                                DialogResult result = MessageBox.Show("是否花15元重生\n"
                                    , "GAMEOVER", MessageBoxButtons.YesNo, MessageBoxIcon.Warning);
                                if (result == DialogResult.Yes)
                                {
                                    game.gameover = false;
                                    player.x = 0;
                                    player.y = 0;
                                    for (int j = 0; j < game.boardsize; j++)
                                    {
                                        monsters.monstz_list[j] = 0;
                                    }
                                    SolidBrush backclean = new SolidBrush(Color.Gray);
                                    canvas.FillRectangle(backclean, 0, 0, mycanvas.width, mycanvas.height);
                                    game.move = true;
                                    game.movemouse = true;
                                    game.money -= 15;
                                }
                                else
                                {
                                    game.gameover = true;
                                }
                            }
                        }
                        else
                        {
                            game.gameover = true;
                            break;
                        }
                    }
                }
            }
            if (game.gameover)
            {
                timer1.Enabled = false;
                timer2.Enabled = false;
                timer3.Enabled = false;
                game.move = false;
                game.movemouse = false;
                string str = string.Format("存活秒數:{0}", game.timepass);
                canvas.DrawString(str, DefaultFont, Brushes.White, 10, 20);
                SolidBrush mySolidBrush = new SolidBrush(Color.Blue);
                canvas.FillEllipse(mySolidBrush, player.x, player.y, player.r * 2, player.r * 2);
                for (int i = 1; i < game.boardsize; i++)
                {
                    if (monsters.monstz_list[i] == 1)
                    {
                        SolidBrush myBrush;
                        if (i % 5 == 0)
                        {
                            myBrush = new SolidBrush(Color.Red);
                        }
                        else if (i % 3 == 0)
                        {
                            myBrush = new SolidBrush(Color.Yellow);
                        }
                        else if (i % 2 == 0)
                        {
                            myBrush = new SolidBrush(Color.LightGreen);
                        }
                        else
                        {
                            myBrush = new SolidBrush(Color.SkyBlue);
                        }
                        canvas.FillEllipse(myBrush, monsters.monstx_list[i], monsters.monsty_list[i], monsters.er * 2, monsters.er * 2);
                    }
                }
                if (entername == false)
                {
                    entername = true;
                    Form4 f = new Form4();
                    DialogResult dr = f.ShowDialog();
                    if(dr==DialogResult.OK)
                    {
                        MessageBox.Show(f.GetMsg());
                        player.name = f.GetMsg();
                    }
                    int count = 0;
                    if (File.Exists("data.txt") == false)
                    {
                        FileStream filestream = new FileStream("data.txt", FileMode.Create);
                        filestream.Close();
                    }
                    if(File.Exists("scores.txt")==false)
                    {
                        FileStream filestream = new FileStream("scores.txt", FileMode.Create);
                        filestream.Close();
                    }

                    using (StreamReader sr = new StreamReader("data.txt"))
                    {
                        while((player.players[count]=sr.ReadLine())!=null)
                        {
                            Console.WriteLine(player.players[count]);
                            count += 1;
                        }
                        sr.Close();
                    }
                    using (StreamReader sr = new StreamReader("scores.txt"))
                    {
                        count = 0;
                        while ((player.scores[count] = sr.ReadLine()) != null)
                        {
                            Console.WriteLine(player.scores[count]);
                            count += 1;
                        }
                        sr.Close();
                    }
                    if(count==0)
                    {
                        string score;
                        score = game.timepass.ToString();
                        File.WriteAllText("data.txt", player.name);
                        File.WriteAllText("scores.txt", score);
                    }
                    else
                    {
                        player.players[count] = player.name;
                        player.scores[count] = game.timepass.ToString();
                        count += 1;
                        for(int i=0; i<count; i++)
                        {
                            for(int j=i; j<count; j++)
                            {
                                int a = 0, b = 0;
                                a = int.Parse(player.scores[i]);
                                b = int.Parse(player.scores[j]);
                                if(b>a)
                                {
                                    int c = a;
                                    player.scores[i] = b.ToString();
                                    player.scores[j] = c.ToString();
                                    string s;
                                    s = String.Copy(player.players[i]);
                                    player.players[i] = String.Copy(player.players[j]);
                                    player.players[j] = String.Copy(s);
                                }
                            }
                        }
                        FileStream f1 = new FileStream("data.txt",FileMode.Create);
                        StreamWriter s1 = new StreamWriter(f1);
                        FileStream f2 = new FileStream("scores.txt", FileMode.Create);
                        StreamWriter s2 = new StreamWriter(f2);
                        for (int i=0;i<count;i++)
                        {
                            s1.Write(player.players[i], 0, player.players[i].Length);
                            s1.WriteLine();
                            s2.Write(player.scores[i], 0, player.scores[i].Length);
                            s2.WriteLine();
                        }
                        s1.Close();
                        s2.Close();
                    }
                }
            }
        }
        float moneyx = 0, moneyy = 0;
        public void createmoney()
        {
            if (game.move)
            {
                moneyx = ran.Next(40, 400);
                moneyy = ran.Next(40, 320);
                if (Pmoney.play == false)
                {
                    Pmoney.playx = moneyx;
                    Pmoney.playy = moneyy;
                    Pmoney.play = true;
                }
            }

        }
        public void draw()
        {
            if (game.movemouse)
            {
                string str = string.Format("存活秒數:{0}", game.timepass);
                canvas.DrawString(str, DefaultFont, Brushes.White, 10, 20);
                string mon = string.Format("MONEY:{0}", game.money);
                canvas.DrawString(mon, DefaultFont, Brushes.White, 500, 25);

                if (game.move)
                {
                    for (int i = 0; i < game.boardsize; i++)
                    {
                        if (monsters.monstz_list[i] == 1)
                        {
                            SolidBrush refreshBrush = new SolidBrush(Color.Gray);
                            canvas.FillEllipse(refreshBrush, monsters.monstx_list[i], monsters.monsty_list[i], monsters.er * 2, monsters.er * 2);
                            monsters.dx = player.x + player.r - monsters.monstx_list[i] - monsters.er;
                            monsters.dy = player.y + player.r - monsters.monsty_list[i] - monsters.er;
                            float L = (float)Math.Sqrt(monsters.dx * monsters.dx + monsters.dy * monsters.dy);
                            monsters.monstx_list[i] = monsters.monstx_list[i] + monsters.dx / L * monsters.esp;
                            monsters.monsty_list[i] = monsters.monsty_list[i] + monsters.dy / L * monsters.esp;
                            SolidBrush myBrush;
                            if (i % 5 == 0)
                            {
                                myBrush = new SolidBrush(Color.Red);
                            }
                            else if (i % 3 == 0)
                            {
                                myBrush = new SolidBrush(Color.Yellow);
                            }
                            else if (i % 2 == 0)
                            {
                                myBrush = new SolidBrush(Color.LightGreen);
                            }
                            else
                            {
                                myBrush = new SolidBrush(Color.SkyBlue);
                            }
                            canvas.FillEllipse(myBrush, monsters.monstx_list[i], monsters.monsty_list[i], monsters.er * 2, monsters.er * 2);
                        }
                    }
                }
            }

        }

    }
}