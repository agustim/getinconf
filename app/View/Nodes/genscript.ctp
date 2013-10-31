<?php

	//Debugger::dump($_SERVER);
	//echo "PATH:".ROOT.DS.APP_DIR.DS."Exec".DS."\n";

	$tincpath = "/etc/tinc/";
	$pagecode = "";

	$pagecode .= "#!/bin/sh\n\n";
	
	if($allconfig == 1) {
		$pagecode .= "mkdir -p ".$tincpath.$node['Network']['name']."\n";
		$pagecode .=  "cat > ".$tincpath.$node['Network']['name']."/tinc.conf <<EOF\n";

		foreach($connectfrom as $cnode) {
			if ($cnode['Node']['rsakeypub'] != "" ) {
				$pagecode .=  "ConnectTo=".$cnode['Node']['name']."\n";
			}
		}
		$pagecode .= "Device=".$node['Node']['device']."\n";
		$pagecode .= "Name=".$node['Node']['name']."\n";
		$pagecode .= "PrivateKeyFile=/etc/tinc/rsa_key.priv\n";
		$pagecode .= "EOF\n";
		$pagecode .= "cat > ".$tincpath.$node['Network']['name']."/tinc-up <<EOF\n";
		$pagecode .= "#!/bin/sh\n";
		$pagecode .= 'ifconfig \$INTERFACE '.$node['Node']['ip']." netmask ".$node['Network']['netmask']."\n";
		$pagecode .= "iptables -t nat -A POSTROUTING -s ".$node['Network']['ip']."/".$node['Network']['bitmask']." ! -d ".$node['Network']['ip']."/".$node['Network']['bitmask']." -j MASQUERADE\n";
		$pagecode .= "EOF\n";
		$pagecode .= "chmod +x ".$tincpath.$node['Network']['name']."/tinc-up\n";
        	$pagecode .= "cat > ".$tincpath.$node['Network']['name']."/tinc-down <<EOF\n";
        	$pagecode .= "#!/bin/sh\n";
        	$pagecode .= 'ifconfig \$INTERFACE down'."\n";
        	$pagecode .= "iptables -t nat -D POSTROUTING -s ".$node['Network']['ip']."/".$node['Network']['bitmask']." ! -d ".$node['Network']['ip']."/".$node['Network']['bitmask']." -j MASQUERADE\n";
        	$pagecode .= "EOF\n";
		$pagecode .= "chmod +x ".$tincpath.$node['Network']['name']."/tinc-down\n";
		$pagecode .= "mkdir -p ".$tincpath.$node['Network']['name']."/hosts\n";
        }
	/* All nodes what are your node connect */
        foreach($connectfrom as $cnode) {
                if ($cnode['Node']['rsakeypub'] != "" ) {
                        $pagecode .= "cat > ".$tincpath.$node['Network']['name']."/hosts/".$cnode['Node']['name']." <<EOF\n";
			$pagecode .= "Compression=11\n";
			$pagecode .= "Subnet=".$cnode['Node']['ip']."/".$cnode['Node']['bitmask']."\n";
    			if($cnode['Node']['address']) { $pagecode .= "Address=".$cnode['Node']['address']."\n"; }
			$pagecode .= "\n";
			$pagecode .= $cnode['Node']['rsakeypub']."\n";
			$pagecode .= "EOF\n";
                }
        }
	/* All nodes to connect you node */
        foreach($connectto as $cnode) {
                if ($cnode['Node']['rsakeypub'] != "" ) {
                        $pagecode .= "cat > ".$tincpath.$node['Network']['name']."/hosts/".$cnode['Node']['name']." <<EOF\n";
                        $pagecode .= "Compression=11\n";
                        $pagecode .= "Subnet=".$cnode['Node']['ip']."/".$cnode['Node']['bitmask']."\n";
                        if($cnode['Node']['address']) { $pagecode .= "Address=".$cnode['Node']['address']."\n"; }
                        $pagecode .= "\n";
                        $pagecode .= $cnode['Node']['rsakeypub']."\n";
                        $pagecode .= "EOF\n";
                }
        }
	if($allconfig == 1) {
        	$pagecode .= "cat > ".$tincpath.$node['Network']['name']."/hosts/".$node['Node']['name']." <<EOF\n";
        	$pagecode .= "Compression=11\n";
        	$pagecode .= "Subnet=".$node['Node']['ip']."/".$node['Node']['bitmask']."\n";
        	if($node['Node']['address']) {$pagecode .=  "Address=".$node['Node']['address']."\n"; }
        	$pagecode .= "\n";
        	$pagecode .= $node['Node']['rsakeypub']."\n";
        	$pagecode .= "EOF\n";
	}
	$pagecode .= "\n# End Of Script.\n";
	if (!$encrypt) {
		echo "$pagecode";
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
