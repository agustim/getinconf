<?php

function write_node ($node, $network, $tincp) {
	$ret = "";
    $ret .= "cat > ".$tincp.$network['Network']['name']."/hosts/".$node['Node']['name']." <<EOF\n";
    if ($network['Network']['mode'] == "router"){
    	$ret .= "Subnet=".$node['Node']['ip']."/32\n";
    }
    $ret .= "Compression=10\n";

    if($node['Node']['address']) { 
    	$ret .= "Address=".$node['Node']['address']."\n"; 
    	if($node['Node']['port'] != 665) { 
    		$ret .= "Port=".$node['Node']['port']."\n"; 
    	}
    }
    $ret .= "\n";
    $ret .= $node['Node']['rsakeypub']."\n";
    $ret .= "EOF\n";
    return $ret;
}
	//Debugger::dump($_SERVER);
	//echo "PATH:".ROOT.DS.APP_DIR.DS."Exec".DS."\n";

	$tincpath = "/etc/tinc/";
	$pagecode = "";

	$pagecode .= "#!/bin/sh\n\n";
	
	if($allconfig == 1) {
		$pagecode .= "mkdir -p ".$tincpath.$node['Network']['name']."\n";
		$pagecode .=  "cat > ".$tincpath.$node['Network']['name']."/tinc.conf <<EOF\n";

		foreach($connectto as $cnode) {
			if ($cnode['Node']['rsakeypub'] != ""  && $cnode['Node']['address'] != "") {
				$pagecode .=  "ConnectTo=".$cnode['Node']['name']."\n";
			}
		}
		$pagecode .= "Device=".$node['Node']['device']."\n";
		$pagecode .= "Mode=".$node['Network']['mode']."\n";
		$pagecode .= "Name=".$node['Node']['name']."\n";
    	if($node['Node']['port'] != 665) { 
    		$pagecode .= "Port=".$node['Node']['port']."\n"; 
    	}
		$pagecode .= "PrivateKeyFile=/etc/tinc/rsa_key.priv\n";
		$pagecode .= "EOF\n";
		$pagecode .= "cat > ".$tincpath.$node['Network']['name']."/tinc-up <<EOF\n";
		$pagecode .= "#!/bin/sh\n";
		$pagecode .= 'ip -4 addr add '.$node['Node']['ip'].'/'.$node['Network']['bitmask'].' dev \$INTERFACE'."\n";
		$pagecode .= 'ip link set \$INTERFACE up'."\n";
		$pagecode .= "EOF\n";
		$pagecode .= "chmod +x ".$tincpath.$node['Network']['name']."/tinc-up\n";
        $pagecode .= "cat > ".$tincpath.$node['Network']['name']."/tinc-down <<EOF\n";
        $pagecode .= "#!/bin/sh\n";
		$pagecode .= 'ip link set \$INTERFACE down'."\n";
		$pagecode .= 'ip -4 addr del '.$node['Node']['ip'].'/'.$node['Network']['bitmask'].' dev \$INTERFACE'."\n";
        $pagecode .= "EOF\n";
		$pagecode .= "chmod +x ".$tincpath.$node['Network']['name']."/tinc-down\n";
		$pagecode .= "mkdir -p ".$tincpath.$node['Network']['name']."/hosts\n";
        }

	/* All nodes to connect you node */
        foreach($connectto as $cnode) {
                if ($cnode['Node']['rsakeypub'] != "" ) {
                	$pagecode .= write_node($cnode, $node, $tincpath);
                }
        }
	if($allconfig == 1) {
		$pagecode .= write_node($node,$node,$tincpath);
	}
	$pagecode .= "\n# End Of Script.\n";
	if (!$encrypt) {
		echo $pagecode;
	} else {
		$RSAPATH = ROOT.DS.APP_DIR.DS."Exec".DS;
		$EXECPATH = $RSAPATH."encrypt";
		$temp_file = tempnam(sys_get_temp_dir(), 'RSA');
		file_put_contents($temp_file,$node['Node']['rsakeypub']);

		ob_start();
		passthru("echo '$pagecode' | ".ROOT.DS.APP_DIR.DS."Exec".DS."encrypt $temp_file", $result);
		$content_grabbed=ob_get_contents();
		ob_end_clean();

		echo "$content_grabbed";
		//borrar temporal
		unlink ($temp_file);
	}


?>
