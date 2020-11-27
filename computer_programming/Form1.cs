using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace MultiForm
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
            MaximizeBox = false;
        }
        private void Form1_Load(object sender, EventArgs e)
        {

        }
        private void button1_Click(object sender, EventArgs e)
        {
            Form2 f = new Form2();
            this.Visible = false;
            f.Visible = true;
        }
        void f2_FormClosing(object sender, FormClosingEventArgs e)
        {
            this.Show();
        }
        private void button3_Click(object sender, EventArgs e)
        {
            MessageBox.Show("用滑鼠操控躲開球，\n" +
            "集到一定數量的錢錢就可以使用道具\n" +
            "shrink為\"z\"鍵$1\n"+
            "slow為\"x\"鍵$5\n"+
            "clean為\"c\"鍵$10\n"+
            "revive$15\n", "遊戲說明", MessageBoxButtons.OK, MessageBoxIcon.None);
        }

        private void button2_Click(object sender, EventArgs e)
        {
            Form3 f = new Form3();
            this.Visible = false;
            f.Visible = true;
        }
    }
}
