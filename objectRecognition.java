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
	jt2= new JTextField();
	jb1= new JButton("Compare");            //  a button in GUI for Compare
	jb2= new JButton("Browse");              //  button for browsing the directory
	jb3= new JButton("Browse");              //  button for browsing the location of image
	jb1.addActionListener(this);
	jb2.addActionListener(this);
	jb3.addActionListener(this);
	
	j1.setBounds(20,50,150,25);
	c.add(j1);
	jt1.setBounds(150,50,120,25);
	c.add(jt1);
	j2.setBounds(20,80,150,25);
	c.add(j2);
	jt2.setBounds(150,80,120,25);
	c.add(jt2);
	jb2.setBounds(300,50,120,25);
	c.add(jb2);
	jb3.setBounds(300,80,120,25);
	c.add(jb3);
	jb1.setBounds(200,250,120,25);
	 c.add(jb1);
	j.setSize(500,500);
	j.setVisible(true);
   }	


 public void actionPerformed(ActionEvent ae)
 {
     if(ae.getSource()==jb2)
      {
     	if(directoryDialog == null)
	{
	          	directoryDialog = new JDirectoryDialog(null);
	}
	if(directoryDialog.showDirectoryDialog())
	{
		File destFile = directoryDialog.getSelectedFolder();
		path =destFile.getAbsolutePath();
		jt1.setText(path);
	}
     }
     
     else if(ae.getSource()==jb3)
     {
     	JFileChooser tFileChooser=new JFileChooser();
	tFileChooser.setFileSelectionMode(JFileChooser.FILES_ONLY);
	int tResult=tFileChooser.showOpenDialog(null);
			
	if(tResult==JFileChooser.APPROVE_OPTION)
	{
		path1=tFileChooser.getSelectedFile().toString();
		jt2.setText(path1);
	}
      }
 
 else
 {
  	if(path==null)
  	{	JOptionPane.showMessageDialog(null,"Please select database","database not selected",1);
  	}
  	if(path1==null)
  	{	JOptionPane.showMessageDialog(null,"Please select input file","input not selected",1);
  	}
  	TestFaceRecognition t=new TestFaceRecognition(path,path1);
  }

}

}
class sow
{
	public static void main(String a[])
	{
		demo d= new demo();
	}
}



/*----- Module2 : Test Face Recognition------*/

import java.lang.*;
import java.io.*;
import javax.swing.*;

public class TestFaceRecognition 
{
	String dir = null;
        	String file =null;
    
	TestFaceRecognition(String dir,String file) 
	{
		this.dir=dir;
		this.file=file;
      	  try {
        		EigenFaceCreator creator = new EigenFaceCreator();
               System.out.println("Constructing face-spaces from "+dir+" ...");
        		creator.readFaceBundles(dir);
             
System.out.println("Comparing "+file+" ...");
        		String result = creator.checkAgainst(file);
        		System.out.println(result);
System.out.println("Most closly reseambling: "+result+" with           
                                  "+creator.DISTANCE+"     distance");
        
JFrame f=new JFrame(result);
       		JOptionPane.showMessageDialog(null,"matched with "+result,"Macth Info",1);
        		JLabel l=new JLabel( new ImageIcon("sow//"+result));
        		f.add(l);
         		f.setSize(320,240);
         		f.setLocation(200,200);
        		if(result!=null)
         		       f.show();
         		else
         		{
         		           JOptionPane.showMessageDialog(null,"null match found","Macth Info",1);
       		}
         
        	         } 
         
        	   catch (Exception e) { e.printStackTrace(); }
   	 }
 }


/*-----Module 3: Eigen Face Creator-----*/

import java.io.*;
import java.util.*;
import java.lang.*;
import javax.swing.*;

public class EigenFaceCreator 
{
private File root_dir;
  	private static final int MAGIC_SETNR = 16;
  	private FaceBundle[] b = null;
  
       /**
       * Our threshold for accepting the matched image. Anything above this
       * number is considered as not found in any of the face-spaces.
       */
  	public static double THRESHOLD = 4.0;
public double DISTANCE = Double.MAX_VALUE;

public int USE_CACHE = 1;

      /*
      * Match against the given file.
      * @return  The Identifier of the image in the face-space. If image not
      * found (based on THRESHOLD) null is returned.
      */
public String checkAgainst(String f) throws FileNotFoundException, IOException {
String id = null;
    	if (b != null) 
{
      		double small = Double.MAX_VALUE;
int idx = -1;
     		double[] img = readImage(f);

      		for (int i = 0; i < b.length; i++) 
{
        			b[i].submitFace(img);
     			if (small > b[i].distance() ) {
          			small = b[i].distance();
            			idx = i;
        		}
   	}
     
DISTANCE = small;
    	if (small < THRESHOLD)
       	       id = b[idx].getID();
    }
    return id;
  }
  /**
   * Construct the face-spaces from the given directory. There must be at least sixteen images in that directory and   
   *each image must have the same dimensions. The face-space bundles are also cached in that directory for speeding    
   * up further initialization.     
  */
  public void readFaceBundles(String n) throws FileNotFoundException, IOException, IllegalArgumentException,  ClassNotFoundException
 {

root_dir = new File(n);
 	File[] files= root_dir.listFiles(new ImageFilter());
  	Vector filenames = new Vector();
String[] set = new String[MAGIC_SETNR];
int i= 0;

    // Sort the list of filenames
 	 for ( i = 0; i < files.length; i++) 
{
      		  filenames.addElement(files[i].getName());
    	}
  	Collections.sort((List)filenames);
b = new FaceBundle[(files.length / MAGIC_SETNR)+1];

    	// Read each set of 16 images.
  	for (i = 0; i < b.length; i++)
{
      	         for (int j = 0; j < MAGIC_SETNR;j++) 
        {
        		if (filenames.size() > j+MAGIC_SETNR*i) 
{
          set[j] = (String)filenames.get(j+MAGIC_SETNR*i);
          	               }
      	        }
      	         b[i] = submitSet(root_dir.getAbsolutePath() + "/",set);
}
  }

  /*
   * Submit a set of sixteen images in the directory and construct a face-space object. This
   * can be done either by reading the cached objects (if there are any) 
   */

  private FaceBundle submitSet(String dir, String[] files) throws FileNotFoundException, IOException,   
IllegalArgumentException, ClassNotFoundException 
{

 	if (files.length != MAGIC_SETNR)
     		throw new IllegalArgumentException("Can only accept a set of "+MAGIC_SETNR+" files.");

    	FaceBundle bundle  = null;
  	int i =0;
    	String name = "cache";
    
try{
for (i = 0; i < files.length; i++)
  {
     		name = name + files[i].substring(0,files[i].indexOf('.')); // Construct the cache name
    	  }
}


catch (NullPointerException e)
{  	JOptionPane.showMessageDialog(null,"database contains files other than imges or folder is empty","error",1);
}
   	 // Check to see if a FaceBundle cache has been saved

  	File f = new File(dir + name + ".cache");

   	if (f.exists() && (USE_CACHE > 0))
      bundle = readBundle(f);
    	else 
{
      bundle = computeBundle(dir, files);
    	      if (USE_CACHE > 0)
    	      saveBundle(f, bundle);
  	}
return bundle;
  }

  private void saveBundle(File f, FaceBundle bundle) throws FileNotFoundException, 
  IOException
{
f.createNewFile();
    	FileOutputStream out = new FileOutputStream(f.getAbsolutePath());
      	ObjectOutputStream fos = new ObjectOutputStream(out);
    	fos.writeObject(bundle);
 	fos.close();
}

private FaceBundle readBundle(File f) throws FileNotFoundException, IOException, ClassNotFoundException
{
FileInputStream in = new FileInputStream(f);
ObjectInputStream fo = new ObjectInputStream(in);
   	FaceBundle bundle = (FaceBundle)fo.readObject();
    	fo.close();
    	return bundle;
}

private FaceBundle computeBundle(String dir, String[] id) throws IllegalArgumentException, 
FileNotFoundException, IOException
{
xxxFile[] files = new xxxFile[MAGIC_SETNR];
    	xxxFile file = null;
    	String temp = null;
    	int width = 0;
    	int height = 0;
    	int i = 0;

    	for (i = 0; i < files.length; i++)
{
      		temp = id[i].toLowerCase();
      		temp = temp.substring(temp.lastIndexOf('.')+1,temp.length());
      		if (temp.equals("jpg") || temp.equals("jpeg")) 
file = new JPGFile(dir+id[i]);
      		else if (temp.equals("ppm") || temp.equals("pnm")) 
file = new PPMFile(dir+id[i]);
    		if (file == null)
        			throw new IllegalArgumentException(id[i]+" is not an image file!");

      		files[i] = file;

     		 if (i == 0) 
{
        			width = files[i].getWidth();
        			height = files[i].getHeight();
      		}
      		if ((width != files[i].getWidth()) || (height != files[i].getHeight()) )
      	{ 	JOptionPane.showMessageDialog(null,"Images in database not of size 
200x200","error",1);
      		throw new IllegalArgumentException("All image files must have the same width and height!");
        
      		}
    	}

double[][] face_v = new double[MAGIC_SETNR][width*height];
