 <?

 $linkptrn = "/<a[^>]*>/";
    $found = preg_match($linkptrn, $html, $a_elem);

    // If no link, do nothing
    if($found <= 0) return $html;

    $a_elem = $a_elem[0];

    // Check to see if the link is to an uploaded image
    $is_attachment_link = strstr($a_elem, "wp-content/uploads/");

    // If link is to external resource, do nothing
    if($is_attachment_link === FALSE) return $html;

    if(strstr($a_elem, "class=\"") !== FALSE){ // If link already has class defined inject it to attribute
        $a_elem_new = str_replace("class=\"", "class=\"colorbox ", $a_elem);
        $html = str_replace($a_elem, $a_elem_new, $html);
    }else{ // If no class defined, just add class attribute
        $html = str_replace("<a ", "<a class=\"colorbox\" ", $html);
    }