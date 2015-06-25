<?php
define('_DIR_PLUGINS_SUPPL', _DIR_RACINE.'squelettes/plugins/');

function upgrade_produits(){
	$all = sql_allfetsel("*","spip_produits");

	include_once(_DIR_PLUGIN_SALE."sale_fonctions.php");
	foreach($all as $produit){

		#var_dump($produit);
		$set = array();
		$set['texte'] = sale($produit['texte']);
		$set['texte'] = preg_replace(",</?p>\s*,ims","\n\n",$set['texte']);
		$set['texte'] = preg_replace(",<br>(\n+),ims","\\1",$set['texte']);
		$set['texte'] = trim($set['texte'])."\n";
		$set['reference'] = trim($produit['reference']);
		if (!$set['reference']){
			$set['reference'] = 'P'.trim($produit['old_id']);
			#var_dump($set);
			#die();
		}
		sql_updateq("spip_produits",$set,'id_produit='.intval($produit['id_produit']));
	}

	die('ok?');
}

/**
 * Dependances

Path: plugins/commandes
Working Copy Root Path: /Users/cedric/Sites/boutique-infogm.nursit.com/squelettes/plugins/commandes
URL: svn://zone.spip.org/spip-zone/_plugins_/commandes/trunk
Repository Root: svn://zone.spip.org/spip-zone
Repository UUID: ac52e18a-acf5-0310-9fe8-c4428f23b10a
Revision: 90440
Node Kind: directory
Schedule: normal
Last Changed Author: rastapopoulos@spip.org
Last Changed Rev: 90439
Last Changed Date: 2015-06-22 16:41:19 +0200 (Lun, 22 jui 2015)

Path: plugins/commandes_paniers
Working Copy Root Path: /Users/cedric/Sites/boutique-infogm.nursit.com/squelettes/plugins/commandes_paniers
URL: svn://zone.spip.org/spip-zone/_plugins_/commandes_paniers/trunk
Repository Root: svn://zone.spip.org/spip-zone
Repository UUID: ac52e18a-acf5-0310-9fe8-c4428f23b10a
Revision: 90440
Node Kind: directory
Schedule: normal
Last Changed Author: spip.franck@lien-d-amis.net
Last Changed Rev: 88083
Last Changed Date: 2015-03-19 22:17:34 +0100 (Jeu, 19 mar 2015)

Path: plugins/paniers
Working Copy Root Path: /Users/cedric/Sites/boutique-infogm.nursit.com/squelettes/plugins/paniers
URL: svn://zone.spip.org/spip-zone/_plugins_/paniers/trunk
Repository Root: svn://zone.spip.org/spip-zone
Repository UUID: ac52e18a-acf5-0310-9fe8-c4428f23b10a
Revision: 90507
Node Kind: directory
Schedule: normal
Last Changed Author: toutati@free.fr
Last Changed Rev: 90486
Last Changed Date: 2015-06-24 16:27:34 +0200 (Mer, 24 jui 2015)

Path: plugins/prix
Working Copy Root Path: /Users/cedric/Sites/boutique-infogm.nursit.com/squelettes/plugins/prix
URL: svn://zone.spip.org/spip-zone/_plugins_/prix
Repository Root: svn://zone.spip.org/spip-zone
Repository UUID: ac52e18a-acf5-0310-9fe8-c4428f23b10a
Revision: 90440
Node Kind: directory
Schedule: normal
Last Changed Author: abelass@gmail.com
Last Changed Rev: 86235
Last Changed Date: 2014-11-22 12:00:35 +0100 (Sam, 22 nov 2014)

Path: plugins/produits
Working Copy Root Path: /Users/cedric/Sites/boutique-infogm.nursit.com/squelettes/plugins/produits
URL: svn://zone.spip.org/spip-zone/_plugins_/produits/trunk
Repository Root: svn://zone.spip.org/spip-zone
Repository UUID: ac52e18a-acf5-0310-9fe8-c4428f23b10a
Revision: 90429
Node Kind: directory
Schedule: normal
Last Changed Author: salvatore@rezo.net
Last Changed Rev: 89772
Last Changed Date: 2015-05-30 05:32:41 +0200 (Sam, 30 mai 2015)

*/