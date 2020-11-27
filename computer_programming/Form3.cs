using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.IO;

namespace MultiForm
{
    public partial class Form3 : Form
    {
        public Form3()
        {
            InitializeComponent();
        }

        private void Form3_Load(object sender, EventArgs e)
        {
            int count = 0;
            string[] players = new string[5];
            string[] scores = new string[5];
            if (File.Exists("data.txt") == false)
            {
                FileStream filestream = new FileStream("data.txt", FileMode.Create);
                filestream.Close();
            }
            if (File.Exists("scores.txt") == false)
            {
                FileStream filestream = new FileStream("scores.txt", FileMode.Create);
                filestream.Close();
            }
            using (StreamReader sr = new StreamReader("data.txt"))
            {
                while ((players[count] = sr.ReadLine()) != null)
                {
                    Console.WriteLine(players[count]);
                    count += 1;
                }
                sr.Close();
            }
            using (StreamReader sr = new StreamReader("scores.txt"))
            {
                count = 0;
                while ((scores[count] = sr.ReadLine()) != null)
                {
                    Console.WriteLine(scores[count]);
                    count += 1;
                }
                sr.Close();
            }
            if (count >= 1)
            {
                label1.Text = players[0];
                label13.Text = scores[0];
            }
            else
            {
                label1.Text = "-----";
                label13.Text = "-----";
            }
            if (count >= 2)
            {
                label2.Text = players[1];
                label14.Text = scores[1];
            }
            else
            {
                label2.Text = "-----";
                label14.Text = "-----";
            }
            if (count >= 3)
            {
                label3.Text = players[2];
                label15.Text = scores[2];
            }
            else
            {
                label3.Text = "-----";
                label15.Text = "-----";
            }
            if (count >= 4)
            {
                label4.Text = players[3];
                label16.Text = scores[3];
            }
            else
            {
                label4.Text = "-----";
                label16.Text = "-----";
            }
            if (count >= 5)
            {
                label5.Text = players[4];
                label17.Text = scores[4];
            }
            else
            {
                label5.Text = "-----";
                label17.Text = "-----";
            }
        }

        private void button1_Click(object sender, EventArgs e)
        {

            Form1 f = new Form1();
            this.Visible = false;
            f.Visible = true;

        }
    }
}
