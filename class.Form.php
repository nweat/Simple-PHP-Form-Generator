<?php
/**
 * Simple Form Generator 
 * @author Nicole Weatherburne
 * Contact: nikkiweat@gmail.com
 * Website: http://nicolewdev.com
 * 
 *  */

class Form {
 
  /**
   * Generate form start tag
   * @return string formstart tag
   */
  public function formStart($name, $id, $method='POST', $action='', $attributes=array())
  {
  	$_formstrt = '';
  	if ((!empty($name) && trim($name)!=''))
  	{
  	$_formstrt = '<form';
  	$_formstrt .= ' name = '.trim($name);
  	$_formstrt .= ' id = '.trim($id);
  	$_formstrt .= ' method = '.trim($method);
  	$_formstrt .= ' action = '.trim($action);
  	$_formstrt .= ' '.implode(' ', $attributes); //add any other additional attributes
  	$_formstrt .= '>';
  	}else
  		return 'Invalid Form';
  	return $_formstrt;
  }
   
  /**
   * Generate form end tag
   * @return string formend tag
  */
  public function formEnd()
  {
  	$_formend = '';
  	$_formend = '</form>';
  	return $_formend;
  }
  
  /**
   * Generate specified start tag
   * @return string start tag
  */
  public function startTag($t, $attributes=array()) {
  	$_tag= '';
   	$_tag = "<$t";
   	$_tag .= ' '.implode(' ', $attributes); //add any other additional attributes
  	$_tag .= '>';
  	return $_tag;
  }
  
  /**
   * Generate specified end tag
   * @return string end tag
  */
  public function endTag($t) {
  	$_tag= '';
  	$_tag = "</$t";
  	$_tag .= '>';
  	return $_tag;
  }
 
  /**
   * Generate label for elements
   * @return string label
   * 
  */
  public function addLabel($name)
  {
  	$_label= '';
  	$name = trim(strip_tags(htmlspecialchars($name)));
  	$_label ="<label for =".$name.">".$name."</label>";
  	return $_label;
  }
  
  
  /**
  * Generate input type elements
  * @param string $type
  * @param string $name 
  * @param string $id 
  * @param mixed $value 
  * @param array $attributes
  * @return generated element
  */
  public function addInput($type='text', $name='', $id=null, $value=null, $attributes=array()) 
  {
  	$_element = '';
  	$type = strtolower($type);
  	
    //can modify below to specify valid input types
    //($type == 'hidden' || $type == 'password' || $type == 'text' || $type == 'radio' || $type == 'submit' || $type == 'checkbox')
    
  	if ((!empty($name) && trim($name)!=''))
  	{
  		$name=trim(strip_tags(htmlspecialchars($name)));
  		$value=trim(strip_tags(htmlspecialchars($value)));
  		  		
  				if($type == 'radio' || $type == 'checkbox') //specify a label for each radio or checkbox
  		 		{ 
  		 			$_element .="&nbsp<label for =".$value.">".$value."</label>";
  		 		}
  	$_element .= "<input type=\"$type\" name=\"$name\" id=\"$id\" value=\"$value\"";
  	}
  	else 
  		return 'Invalid Element';
 
    $_element .= ' '.implode(' ', $attributes); //add any other additional html attributes, css styling or javascript functions for example
    $_element .= ' />';
   
    return $_element;
   }  
   
   /**
    * Generate text area element
    * @param string $name
    * @param string $id
    * @param mixed $value
    * @param integer $rows
    * @param integer $cols
    * @return generated element
   */

   public function addTextArea($name='', $id=null, $value=null, $rows=5, $cols=20)
   {
   	$_element = '';
   	if(!empty($name) && trim($name)!='')
   	{
   	$_element .= "<textarea name=\"$name\" id=\"$id\" rows=\"$rows\" cols=\"$cols\"";
   	$_element .= '>';
   	$_element .= trim(strip_tags(htmlspecialchars($value)));
   	$_element .= '</textarea>';
   	}else 
   		return 'Invalid Element';
   	
   	return $_element;
   }  
   
   /**
    * Generate dropdown list
    * @param string $name
    * @param string $id
    * @param mixed $values
    * @param mixed $selected
    * @param array $attributes
    * @return generated element
   */
   public function addDropdown($name='', $id=null, $values=array(), $selected=null, $attributes=array())
   {
   	$_element = '';
    $_status = '';
    
   	if(!empty($values) && (!empty($name) && trim($name)!=''))
   	{
   		$_element .= "<select name=\"$name\" id=\"$id\"";
   		$_element .= ' '.implode(' ', $attributes); //add any other additional html attributes, css styling or javascript functions for example
   		$_element .= '>';
   		
   	foreach($values as $val)
   	{
   		if($selected==$val){
   			$_status='selected';
   		}else {
   			$_status='';
   		}
   		$_element .= "<option value=\"$val\"";
   		$_element .= $_status.' >';  //trim(strip_tags(htmlspecialchars($val)))
   		$_element .= $val;
   		$_element .= '</option>';
   	}
   	}else 
   		return 'Invalid Element';

   	$_element .= '</select>';
   	return $_element;
   }
    
}


//=====================================================SAMPLE IMPLEMENTATION
$_dropdownValues=array('White background','Blackbackground','Green background');

$sampleForm=new Form();

echo $sampleForm->formStart('sampleform');
echo $sampleForm->startTag('fieldset');
echo $sampleForm->startTag('legend').'REGISTRATION';
echo $sampleForm->endTag('legend');

echo $sampleForm->startTag('p',array('style="font-weight:bold"'));
echo $sampleForm->addLabel('Email:');
echo $sampleForm->addInput('email', 'Email', 'Email', '',array('required'));
echo $sampleForm->endTag('p');

echo $sampleForm->startTag('p');
echo $sampleForm->addLabel('Password:');
echo $sampleForm->addInput('password', 'Password','Password','',array('required'));
echo $sampleForm->endTag('p');

echo $sampleForm->startTag('p');
echo $sampleForm->addLabel('Preference:');
echo $sampleForm->addDropdown('pref', 'pref', $_dropdownValues,'Green background');
echo $sampleForm->endTag('p');


echo $sampleForm->startTag('p');
echo $sampleForm->addLabel('Gender: ');
echo $sampleForm->addInput('radio', 'Gender','Gender','Male');
echo $sampleForm->addInput('radio', 'Gender','Gender','Female',array('checked'));
echo $sampleForm->endTag('p');

echo $sampleForm->startTag('p');
echo $sampleForm->addLabel('I love: ');
echo $sampleForm->addInput('checkbox', 'Status[]', '', 'Apples','');
echo $sampleForm->addInput('checkbox', 'Status[]', '', 'Oranges','');
echo $sampleForm->endTag('p');


echo $sampleForm->startTag('p');
echo $sampleForm->addLabel('Comments: ');
echo $sampleForm->addTextArea('comments');
echo $sampleForm->endTag('p');

echo $sampleForm->addInput('submit', 'Submit','Submit','Register');
echo $sampleForm->endTag('fieldset');
echo $sampleForm->formEnd();
?>
