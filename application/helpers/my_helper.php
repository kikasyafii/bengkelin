<?php

function switching_date($date){
	list($y,$m,$d) = explode('-',$date);
	$newDate = '0000-00-00';
	
	if (count($y) > 2)
		$newDate =  $d.'-'.$m.'-'.$y;
	else
		$newDate = $y.'-'.$m.'-'.$d;
	
	return $newDate;
}

function the_month($m){
	
	$arrMonth = array(
		'01' => 'Januari', '02'=> 'Februari','03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli',
		'08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
		);
	
	return $arrMonth[$m];
}

function h($h)
{
    if ( is_array($h) )
        return array_map('h', $val);
    return htmlspecialchars($h);
}

function p($x)
{
    $ci =& get_instance();
    return $ci->input->post($x);
}

function g($x)
{
    $ci =& get_instance();
    return $ci->input->get($x);
}

function r($x)
{
    $ci =& get_instance();
    return $ci->input->get_post($x);
}

function is_post_request()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function flashmsg_set($msg)
{
    if (!isset($_SESSION))
        @session_start();
    $_SESSION['_flashmsg'] = $msg;
}

function flashmsg_get()
{
    if (!isset($_SESSION))
        @session_start();
    $msg = isset($_SESSION['_flashmsg']) ? $_SESSION['_flashmsg'] : null;
    if (!is_null($msg)) unset($_SESSION['_flashmsg']);
    return $msg;
}

function auto_code($prefix)
{
    $ci  = & get_instance();
    $ci->db->query("INSERT INTO auto_code (prefix, sequence) VALUES ( ?, 1 ) ON DUPLICATE KEY UPDATE sequence  =  sequence + 1", array($prefix));
    $result  =  $ci->db->query("SELECT sequence FROM auto_code WHERE prefix  =  ?", array($prefix));
    $row  =  $result->row();
    $result  =  strtoupper($prefix) . '-' . str_pad($row->sequence, 5, '0', STR_PAD_LEFT);
    return $result;
}

function unique_id($stub)
{
    require_once APPPATH.'libraries/verhoeff.php';

    $ci  = & get_instance();
    $ci->db->query("REPLACE INTO Tickets32 (stub) VALUES (?)", array($stub));
    $result  =  $ci->db->insert_id();
    $result = verhoeff::generate($result);
    return $result;
}

function secure_seed_rng($count=8)
{
    $output = '';

    // Try the OpenSSL method first. This is the strongest.
    if(function_exists('openssl_random_pseudo_bytes'))
    {
        $output = openssl_random_pseudo_bytes($count, $strong);
        if($strong !== true)
        {
            $output = '';
        }
    }

    if($output == '')
    {
        // Then try the unix/linux method
        if(@is_readable('/dev/puxurandom') && ($handle = @fopen('/dev/urandom', 'rb')))
        {
            $output = @fread($handle, $count);
            @fclose($handle);
        }
		else if(version_compare(PHP_VERSION, '5.0.0', '>=') && class_exists('COM'))
        {
			// Then try the Microsoft method
            try {
                $util = new COM('CAPICOM.Utilities.1');
                $output = base64_decode($util->GetRandom($count, 0));
            }
            catch(Exception $ex) { }
        }
    }

    // Didn't work? Do we still not have enough bytes? Use our own (less secure) rng generator
    if(strlen($output) < $count)
    {
        $output = '';

        // Close to what PHP basically uses internally to seed, but not quite.
        $unique_state = microtime().getmypid();

        for($i = 0; $i < $count; $i += 16)
        {
            $unique_state = md5(microtime().$unique_state);
            $output .= pack('H*', md5($unique_state));
        }
    }

    // /dev/urandom and openssl will always be twice as long as $count. base64_encode will roughly take up 33% more space but crc32 will put it to 32 characters
    $output = hexdec(substr(dechex(crc32(base64_encode($output))), 0, $count));

    return $output;
}

function my_rand($min=null, $max=null, $force_seed=false)
{
    static $seeded = false;
    static $obfuscator = 0;

    if($seeded == false || $force_seed == true)
    {
        mt_srand(secure_seed_rng());
        $seeded = true;

        $obfuscator = abs((int) secure_seed_rng());

        // Ensure that $obfuscator is <= mt_getrandmax() for 64 bit systems.
        if($obfuscator > mt_getrandmax())
        {
            $obfuscator -= mt_getrandmax();
        }
    }

    if($min !== null && $max !== null)
    {
        $distance = $max - $min;
        if ($distance > 0)
        {
            return $min + (int)((float)($distance + 1) * (float)(mt_rand() ^ $obfuscator) / (mt_getrandmax() + 1));
        }
        else
        {
            return mt_rand($min, $max);
        }
    }
    else
    {
        $val = mt_rand() ^ $obfuscator;
        return $val;
    }
}


function fix_float( $array )
{
    if ( is_array( $array ) )
    {
        foreach( $array as $k => $v )
        {
            $array[$k] = fix_float($v);
        }
        return $array;
    }
    else
    {
        return is_float($array) ? round($array,2) : $array;
    }
}

function parse_filter( $filter, $columns=array(), $table='' )
{
    $ci =& get_instance();
    
    if ($table) $table .= ".";
    if ($filter)
    {
        $filter = json_decode($filter);
        if ( $filter && is_array($filter) )
        {
            $first = false;
            
            foreach( $filter as $f )
            {
                if (is_null($f->value)) continue;
                
                if ( isset($f->property) )
                {
                    //search mode
                    if ( !in_array($f->property, $columns ) )
                        continue;
                    
                    //$words = array_unique(array_filter(array_map('trim', explode(' ',$f->value))));
                    //foreach( $words as $word )
                    //{
                        if ( !$first )
                            $ci->db->like( $table.$f->property, $f->value );
                        else
                            $ci->db->or_like( $table.$f->property, $f->value );
                    //}
                }
                else if ( isset($f->field) )
                {
                    //filter mode
                    if ( !in_array($f->field, $columns ) )
                        continue;
                    
                    if ( isset($f->type) && $f->type == 'numeric' ) {
                        switch( $f->comparison ) {
                            case 'lt':
                                $ci->db->where( $table.$f->field.' < ', $f->value );
                                break;
                            case 'gt':
                                $ci->db->where( $table.$f->field.' > ', $f->value );
                                break;
                            default:
                                $ci->db->where( $table.$f->field, $f->value );
                        }
                    } else if ( isset($f->type) && $f->type == 'boolean' ) {
                        $ci->db->where( $table.$f->field, $f->value );
                    } else {
                        if ( !$first )
                            $ci->db->like( $table.$f->field, $f->value);
                        else
                            $ci->db->or_like( $table.$f->field, $f->value);
                    }
                }
            }
        }
    }
    
    return $ci->db;
}

function parse_filter2( $filter, $columns=array(), $table='' )
{
    $ci =& get_instance();
    
    if ($table) $table .= ".";

    $where = "";
    
    if ($filter)
    {
        $filter = json_decode($filter);
        if ( $filter && is_array($filter) )
        {
            $first = false;
            
            foreach( $filter as $f )
            {
                if (is_null($f->value)) continue;
                
                if ( isset($f->property) )
                {
                    //search mode
                    if ( !in_array($f->property, $columns ) )
                        continue;
                    
                    //$words = array_unique(array_filter(array_map('trim', explode(' ',$f->value))));
                    //foreach( $words as $word )
                    //{
                        if ( !$first )
                            $where .= " AND $table".$f->property." LIKE ".$ci->db->escape("%".$f->value."%");
                        else
                            $where .= " OR $table.".$f->property." LIKE ".$ci->db->escape("%".$f->value."%");
                    //}
                }
                else if ( isset($f->field) )
                {
                    //filter mode
                    if ( !in_array($f->field, $columns ) )
                        continue;
                    
                    if ( isset($f->type) && $f->type == 'numeric' ) {
                        switch( $f->comparison ) {
                            case 'lt':
                                $where .= " AND $table".$f->field." < ".$ci->db->escape($f->value);
                                break;
                            case 'gt':
                                $where .= " AND $table".$f->field." > ".$ci->db->escape($f->value);
                                break;
                            default:
                                $where .= " AND $table".$f->field." = ".$ci->db->escape($f->value);
                        }
                    } else if ( isset($f->type) && $f->type == 'boolean' ) {
                        $where .= " AND $table".$f->field." = ".$ci->db->escape($f->value);
                    } else {
                        if ( !$first )
                            $where .= " AND $table".$f->property." LIKE ".$ci->db->escape("%".$f->value."%");
                        else
                            $where .= " OR $table.".$f->property." LIKE ".$ci->db->escape("%".$f->value."%");
                    }
                }
            }
        }
    }
    
    return $where;
}

function parse_sort($sort, $columns, $table='')
{
    $ci =& get_instance();
    if ($table) $table .= ".";

    if ( $sort )
    {
        $sort = json_decode($sort);
        if ( $sort && is_array($sort) )
        {
            foreach($sort as $s)
            {
                if ( !in_array($s->property, $columns) )
                    continue;
                $ci->db->order_by( $table.$s->property, $s->direction );
            }
        }
    }
    
    return $ci->db;
}

function parse_sort2($sort, $columns, $table='')
{
    $ci =& get_instance();
    if ($table) $table .= ".";
    
    $order = '';
    
    if ( $sort )
    {
        $sort = json_decode($sort);
        if ( $sort && is_array($sort) )
        {
            foreach($sort as $s)
            {
                if ( !in_array($s->property, $columns) )
                    continue;
                $order .= ($order ? "," : "") . $table.$s->property . " " . $s->direction;
            }
        }
    }
    
    return $order ? "ORDER BY $order" : "";
}

function html2plain($html)
{
    $html = preg_replace('~/\s*>~', '>', $html);
    $html = preg_replace('~<br[^/>]+/?>~i', "\n", $html);
    $html = preg_replace('~<p[^>]+>~i', "\n\n", $html);
    $html = preg_replace('~<h[1-6][^>]+>~i', "\n", $html);
    $html = preg_replace('~<div[^>]+>~i', "\n", $html);
    $html = preg_replace('~<t[hd][^>]+>~i', " ", $html);
    $html = preg_replace('~<tr[^>]+>~i', "\n\n", $html);
    //$html = preg_replace('~<a[^h]+href\s*=\s*\"([^"]+)\">[^<]+</a>~i', "\1", $html);
    $html = strip_tags($html);
    $html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');
    return trim($html);
}

function time_since2($older_date, $newer_date = false, $format='')
{
    if ( !is_numeric($older_date) )
        $older_date = strtotime($older_date);

    if ( !is_numeric($newer_date) && $newer_date )
        $newer_date = strtotime($newer_date);

    // $newer_date will equal false if we want to know the time elapsed between a date and the current time
    // $newer_date will have a value if we want to work out time elapsed between two known dates
    $newer_date = ($newer_date == false) ? time() : $newer_date;

    // difference in seconds
    $since = $newer_date - $older_date;

    if ( $since > 86400 )
    {
        return date( 'l, d/M/Y H:i', $older_date );
    }

    // array of time period chunks
    global $time_chunks;
    if (!isset($time_chunks))
    {
        $chunks = array(
            array(60 * 60 * 24 * 365 , 'tahun'),
            array(60 * 60 * 24 * 30 , 'bulan'),
            array(60 * 60 * 24 * 7, 'minggu'),
            array(60 * 60 * 24 , 'hari'),
            array(60 * 60 , 'jam'),
            array(60 , 'menit'),
        );
        $time_chunks = $chunks;
    }
    else
    {
        $chunks = $time_chunks;
    }

    // we only want to output two chunks of time here, eg:
    // x years, xx months
    // x days, xx hours
    // so there's only two bits of calculation below:

    // step one: the first chunk
    for ($i = 0, $j = count($chunks); $i < $j; $i++)
    {
        $seconds = $chunks[$i][0];
        $name = $chunks[$i][1];

        // finding the biggest chunk (if the chunk fits, break)
        if (($count = floor($since / $seconds)) != 0)
        {
            break;
        }
    }

    // set output var
    $output = "$count {$name}";

    // step two: the second chunk
    if ($i + 1 < $j)
    {
        $seconds2 = $chunks[$i + 1][0];
        $name2 = $chunks[$i + 1][1];

        if (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0)
        {
            // add to output var
            $output .= ", $count2 {$name2}";
        }
    }

    return "$output";
}

function set_anchor($name,$path,$class=""){
	return '<a href="javascript:void(0);" onclick="action_click(\''.$path.'\');" '.$class.'>'.$name.'</a>';
}

function this_url_is_valid(){
	if (current_url() == base_url() || current_url() == base_url().'index.php/welcome'){
		return true;
	}else{
		return false;
	}
}

function sluggify($url)
{
    # Prep string with some basic normalization
    $url = strtolower($url);
    $url = strip_tags($url);
    $url = stripslashes($url);
    $url = html_entity_decode($url);

    # Remove quotes (can't, etc.)
    $url = str_replace('\'', '', $url);

    # Replace non-alpha numeric with hyphens
    $match = '/[^a-z0-9]+/';
    $replace = '-';
    $url = preg_replace($match, $replace, $url);

    $url = trim($url, '-');

    return $url;
}
