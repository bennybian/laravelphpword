<?php
namespace lphpword;

/**
 *
 * Laravel wrapper for PHPWord
 Laravel PHP word -Lphpword
 

 */
class Lphpword {

	
	
	public

	function __construct() {
	

	}
	/*
	
	Create file from Template: Only single-line values can be replaced.
	You can create an OOXML document template with included search-patterns (macros) which can be replaced by any value you wish. Only single-line values can be replaced.

	To deal with a template file, use new TemplateProcessor statement. After TemplateProcessor instance creation the document template is copied into the temporary directory. Then you can use TemplateProcessor::setValue method to change the value of a search pattern. The search-pattern model is: ${search-pattern}.
	
    ref:http://phpword.readthedocs.io/en/latest/templates-processing.html

	*/
	public

	function createFromTemplate( $fillFields = array(), $templateFileName = "", $outputFilename = "" ) {


		if ( !$fillFields || !$templateFileName || !$outputFilename ) {
			return false;
		}
		$doctemplatefolder = \config::get( "app.doctemplatefolder" );
		$template = new\ PhpOffice\ PhpWord\ TemplateProcessor( $doctemplatefolder . $templateFileName );

		foreach ( $fillFields as $fKey => $fVal ) {
			$template->setValue( $fKey, $fVal );
		}


		// save as a random file in temp file. Ex: /tmp/PHPWordlNtbA8 
		$temp_file = tempnam( sys_get_temp_dir(), 'PHPWord' );
		$template->saveAs( $temp_file );

		$this->savefile( $outputFilename, $temp_file );
		return;

	}
	/**
	 * Create a new file. 
	 TODO: fill text with variable 
	
	 */
	public

	function create( $outputFilename ) {

		$phpWord = new\ PhpOffice\ PhpWord\ PhpWord();
		/* Note: any element you append to a document must reside inside of a Section. */

		// Adding an empty Section to the document...
		$section = $phpWord->addSection();
		// Adding Text element to the Section having font styled by default...
		$section->addText(
			'"Learn from yesterday, live for today, hope for tomorrow. '
			. 'The important thing is not to stop questioning." '
			. '(Albert Einstein)'
		);

		/*
		 * Note: it's possible to customize font style of the Text element you add in three ways:
		 * - inline;
		 * - using named font style (new font style object will be implicitly created);
		 * - using explicitly created font style object.
		 */

		// Adding Text element with font customized inline...
		$section->addText(
			'"Great achievement is usually born of great sacrifice, '
			. 'and is never the result of selfishness." '
			. '(Napoleon Hill)',
			array( 'name' => 'Tahoma', 'size' => 10 )
		);

		// Adding Text element with font customized using named font style...
		$fontStyleName = 'oneUserDefinedStyle';
		$phpWord->addFontStyle(
			$fontStyleName,
			array( 'name' => 'Tahoma', 'size' => 10, 'color' => 'a3402a', 'bold' => true )
		);
		$section->addText(
			'"The greatest accomplishment is not in never falling, '
			. 'but in rising again after you fall." '
			. '(Vince Lombardi)',
			$fontStyleName
		);




		// save as a random file in temp file. Ex: /tmp/PHPWordlNtbA8 

		$temp_file = tempnam( sys_get_temp_dir(), 'PHPWord' );

		// Saving the document as OOXML file...
		$objWriter = \PhpOffice\ PhpWord\ IOFactory::createWriter( $phpWord, 'Word2007' );
		$objWriter->save( $temp_file );

		$this->savefile( $outputFilename, $temp_file );

		//header("Content-Disposition: attachment; filename='myFile.docx'");


		return;

	}
	private
	function savefile( $outputFilename, $temp_file ) {
		// Doc generated on the fly, may change so do not cache it; mark as public or
		// private to be cached.
		header( 'Pragma: no-cache' );
		// Mark file as already expired for cache; mark with RFC 1123 Date Format up to
		// 1 year ahead for caching (ex. Thu, 01 Dec 1994 16:00:00 GMT)
		header( 'Expires: 0' );
		// Forces cache to re-validate with server
		header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
		// DocX Content Type
		header( 'Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document' );
		// Tells browser we are sending file
		header( 'Content-Disposition: attachment; filename=' . $outputFilename . ';' );
		// Tell proxies and gateways method of file transfer
		header( 'Content-Transfer-Encoding: binary' );
		// Indicates the size to receiving browser
		header( 'Content-Length: ' . filesize( $temp_file ) );

		readfile( $temp_file ); // or echo file_get_contents($temp_file);
		unlink( $temp_file ); // remove temp file
		return;

	}

}