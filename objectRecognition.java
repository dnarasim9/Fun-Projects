/*------ main module------*/ 
import java.awt.*;
import javax.swing.*;
import java.awt.event.*;
import java.io.*;
import org.gui.JDirectoryDialog; 
class demo implements ActionListener
{
 	JLabel j1;
	JLabel j2;
	JTextField jt1;
	JTextField jt2;
	JButton jb1;
	JButton jb2;
	JButton jb3;	
	File f;
	File f1;
	String path;          // path of the input directory
	String path1;        // path of the input image
	String msg;
	private JDirectoryDialog directoryDialog;
	
          demo()
        {
	JFrame j= new JFrame("Face Recognition");
	Container c= j.getContentPane();
	c.setLayout(null);
	j1= new JLabel("Select the directory");
	j2= new JLabel("Select the File");
	jt1= new JTextField();
	
