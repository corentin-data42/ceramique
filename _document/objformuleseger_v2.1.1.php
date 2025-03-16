<?php
class ObjFormuleSeger{
	public $r0; //array
	public $r1; //array
	public $r2; //array
	public $r1progression; //array
	public $r2progression; //array
	public $selectionMateriaux;
	public $erreur; //array
	public $pmTotal;
	public $debug;
	
	public function __construct(){
	$this->debug=getParametreSite('MODE_DEBUG_SEGER');
	$this->r0=array();
	$this->r1=array();
	$this->r2=array();
	$this->selectionMateriaux=array();
	$this->erreur=null;
	$this->pmTotal=0;
	}
	
	public function validation(){
		$count = 0;
		foreach($this->r0 as $idOxyde=>$nombreOxyde){
			if($nombreOxyde){
			$count+=$nombreOxyde;
			}
		}
		if(round($count,2)<>round(1,2)){

			$this->erreur = "La somme des oxydes de la colonne R0 doit être égale à un";
			return false;
		}
		return true;
	}
	
	/*
	 *	fonction qui convertie la formule saisie en pourcentage de materiaux disponible en base
	 *
	 */
	public function convEnPourcentage(){
	
		// recuperation de l'ensemple de materiaux actif disponible en base ordonnée du nombre d'oxyde le composant le plus haut au plus petit et suivant l'ordre definit pour chage niveau de complexité 
		$arrMateriaux	=	ObjMateriaux::get(null,true,true);
		
		// Boucle qui elimine un a un les materiaux les plus complexe j'usqu'a avoir obtenue une recette ou etre arrive au materiaux composer de 3 oxydes (felsphate theorique)
		
		// initialisation des variables sur lesquel on va effectuer le teste de la boucle
		$boolArriveAuFelsPath = false;
		$recetteTrouver=false;
		$firstBoucle=true;
		while(!$recetteTrouver and !$boolArriveAuFelsPath){
		
			//echo'<hr/><hr/><hr/><hr/><hr/>';
		
			// initialisation des variables
			
			// elemement de la recette a renvoyer si elle est trouvé id Materiaux / pourcentage dans la recette
			$arrRetour=array();
			$arrMateriauxutilisePm=array();
			// tableau des materiaux qui "pourraient" etre utilise dans la recette car leur composition comporte l'ensemble des oxyde demander 
			$arrMateriauxPossible = array();
			// tableau des materiaux composer deux oxydes a placer en premier dans la liste car l'un des deux ce trouve aussi dans les materiaux plus complexe et que l'autre n'est pas disponible seul
			$arrMateriauxPossibleFirst = array();
			
			// tableau des oxydes trouvé
			$arrOxydeTrouver=array();
			
			
			$this->erreur="";
			
			// pm total de la recette
			$this->pmTotal=0;
		
			// on regroupe dans un seul tableau l'ensemble des oxyde demandé par la formule
			$arrOxydeDemander=$this->r0 +$this->r1 + $this->r2;
			

			// on verifie si le premier materiaux de la liste est composer de 3 ou moins d'oxyde
			$keyFirstMat = array_shift(array_keys($arrMateriaux)); 
			$oFirstMat = $arrMateriaux[$keyFirstMat];
			
			if(count($oFirstMat->oxyde)<=3){
				// si oui on est arriver au feldspath formule theorique on ne relancera pas la boucle meme si aucune recette n'est trouver 
				$boolArriveAuFelsPath = true;
			}
			
			// on parcours le tableau des materiaux disponible en base
			foreach($arrMateriaux as $oMateriaux){	
				
				// initialisation de la variable boolOxIn qui et a true si tous les oxyde du materiaux sont demander par la recette
				$boolOxIn = true;
				
				// on verifie que le materiaux actuel est selectionné dans la liste des materiaux de l'interface
				if(array_key_exists($oMateriaux->id,$this->selectionMateriaux)){
				
					// pour chaque oxyde du materiaux
					foreach($oMateriaux->oxyde as $oOxyde){
						$id= $oOxyde->id;
						// si l'oxyde du materiaux est demander par la formule
						if(array_key_exists($id,$arrOxydeDemander)){
							// si la quantité d'oxyde demander par la formule est null ou zero
							if(!$arrOxydeDemander[$id]){
								// l'oxyde du materiaux n'est pas demander par la formule
								// le materiaux ne peu pas etre utiliser
								$boolOxIn = false;
							}
						}else{
							// l'oxyde du materiaux n'est pas demander par la formule
							// le materiaux ne peu pas etre utiliser
							$boolOxIn = false;
						}
					}
					
					//Si tous les oxydes de ce materiaux son demandées par la formule
					if($boolOxIn){
						// on va verifier si on doit le place en debut de la liste des materiaux a traiter si l'un des deux oxyde ce trouve dans les materiaux plus complexe et que l'autre n'est pas disponible seul
						
						// Si le nombre d'oxyde le composant et supperieur ou egal a 2
						if(count($oMateriaux->oxyde)>=2){
							
							
							//initialisation des variables
							
							
							$incNbOxTrouver=0;
							$arrOxADesindexer=array();
							$arrOxydeSeul =array();
							
							// pour chaque oxyde composant le materiaux
							foreach($oMateriaux->oxyde as $oOxyde){
								
								$id= $oOxyde->id;
							
								// Si l'oxyde a deja etait trouvé dans un materiaux et que sa quantité dans le materiaux actuel est inferieur a celle deja trouvé auparavant
								//if(array_key_exists($id,$arrOxydeTrouver) && $oMateriaux->arrNombreOxyde[$id]>$arrOxydeTrouver[$id]){
								if(array_key_exists($id,$arrOxydeTrouver)){
									
									if($arrOxydeTrouver[$id]){
									
										// incrementation du nombre d'oxyde trouvé
										$incNbOxTrouver++;
										

										/*
										 *
										 * ERREUR DANS L'ALGORITHME
										 *
										 */
#										if($oMateriaux->arrNombreOxyde[$id]<$arrOxydeTrouver[$id]){
#											// Probleme je viens de faire le test inverse juste au dessus donc on ne passe jamais la
#										 
#											$arrOxydeTrouver[$id]=$oMateriaux->arrNombreOxyde[$id];
#										}
										
									}	
								}else{
									// l'oxyde n'a pas deja etait trouvé dans un materiaux ou sa quantité dans le materiaux actuel est inferieur a celle deja trouvé auparavant
									
									/*
									 *
									 * PROBLEME DANS L'ALGORITHME
									 * je doit ajouter dans ce tableau des oxydes qui y sont deja
									 * todo peut etre ajouter un test du type
									 * $oMateriaux->arrNombreOxyde[$id]<$arrOxydeTrouver[$id]
									 * avant l'ajout'
									 */
									 
									// on l'ajoute au tableau d'oxyde seul
									$arrOxydeSeul[]=$id;
									
									// on mes a jour de tableaux des oxydes trouvé et la quantite correspondante
									$arrOxydeTrouver[$id]=$oMateriaux->arrNombreOxyde[$id];
								}
							}
#							var_dump($arrOxydeTrouver);
							//le materiaux contient plus
	#							var_dump($oMateriaux->libelle); 
	#							var_dump($arrOxydeSeul);
	#							var_dump(count($oMateriaux->oxyde));
	#							echo'<br/>'; 
							//if($incNbOxTrouver && count($oMateriaux->oxyde)>$incNbOxTrouver){
							if(count($arrOxydeSeul) && count($oMateriaux->oxyde)>=count($arrOxydeSeul) && count($oMateriaux->oxyde)<3){
#							echo'<hr/>';
								//le materiaux contient plus
#								echo'<br/>';
#								var_dump($oMateriaux->libelle); 
#							 echo'<br/>';
#							 var_dump($arrOxydeSeul); 
								$boolFirst=true;
								foreach($arrOxydeSeul as $idOxyde){
								//unset($arrOxydeTrouver[$idOxyde]);
									if($arrOMat=ObjMateriaux::getMatbyOxyde($idOxyde)){
									
#										var_dump(count($arrOMat));
										if(is_array($arrOMat)){
											foreach($arrOMat as $oMat){
												$oMat=ObjMateriaux::get($oMat->id);
#												if($oMat->arrNombreOxyde[$idOxyde]<$arrOxydeTrouver[$idOxyde]){
#												$boolFirst=false;
#												}
												if(count($oMat->oxyde)==1 && array_key_exists($oMat->id,$this->selectionMateriaux)){		
												
#													echo'<pre>';
#													var_dump($oMat->libelle);
#													echo'</pre>';
													$boolFirst=false;
												}
											}
										}else{
											$oMat=ObjMateriaux::get($arrOMat->id);
#											if($oMat->arrNombreOxyde[$idOxyde]<$arrOxydeTrouver[$idOxyde]){
#												$boolFirst=false;
#											}
											if(count($oMat->oxyde)==1 && array_key_exists($oMat->id,$this->selectionMateriaux)){
													$boolFirst=false;
											}
										}
									
									
	#									if(array_key_exists($id,$arrOxydeTrouver)){
	#							
	#										if($arrOxydeTrouver[$id]){
	#											$incNbOxTrouver++;
	#										}	
	#									}
										if($boolFirst){
											unset($arrOxydeTrouver[$idOxyde]);
										}
									}else{
										//var_dump($idOxyde);
										unset($arrOxydeTrouver[$idOxyde]);
									}
								}
								if($boolFirst){
								
									array_unshift($arrMateriauxPossibleFirst,$oMateriaux);
									//$arrMateriauxPossibleFirst[]=$oMateriaux;
								}else{
									$arrMateriauxPossible[]=$oMateriaux;
								}
							}else{
								$arrMateriauxPossible[]=$oMateriaux;
							}
						}else{
							$arrMateriauxPossible[]=$oMateriaux;
						}
					
					}
				}
			
			}
#			echo'<pre>';
#			var_dump($arrMateriauxPossibleFirst);
#			echo'</pre>';
#			echo'<hr/><hr/>';
			foreach($arrMateriauxPossibleFirst as $oMat){
			
#			echo'<hr/><hr/>';
#			var_dump($oMat);
				array_unshift($arrMateriauxPossible,$oMat);
			}
	#		
#				echo'<pre>';
#			var_dump($arrMateriauxPossible);
#			echo'</pre>';
			
			if(count($arrMateriauxPossible)){
		
				$arrMateriauxutilise=array();
				foreach($arrMateriauxPossible as $oMateriauxPossible){
					//$$oMateriauxPossible;	
					if($this->debug){echo'<hr/>'.$oMateriauxPossible->libelle.'<br/>';}		
				
					$inc=0;
					foreach($oMateriauxPossible->arrNombreOxyde as $idOxyde=>$nombreOxyde){
						if(!$inc){
							$multiplicateur = $arrOxydeDemander[$idOxyde]/$nombreOxyde;	
						}
						$newOxydeMultiplicateur = $arrOxydeDemander[$idOxyde]/$nombreOxyde;
						if($newOxydeMultiplicateur<$multiplicateur){
							$multiplicateur=$newOxydeMultiplicateur;
						}
						$oOxyde=ObjOxyde::get($idOxyde);
						if($this->debug){
						echo $oOxyde->formule.' : '.$arrOxydeDemander[$idOxyde].'/'.$nombreOxyde.' = '.$newOxydeMultiplicateur.'<br/>';}
					
					$inc++;
					}
					if($this->debug){echo 'mutliplicateur materiaux '.$multiplicateur.'<br/>';}
					// traitement
				
					if($multiplicateur && $multiplicateur>0){
						$multiplicateur = round($multiplicateur,3);
						if(!$oMateriauxPossible->pm){
							$oMateriauxPossible->initPm();
						}
						$oMateriauxPossible->pm = round($oMateriauxPossible->pm,3);
				
						//
#						echo'pm materiaux '.$oMateriauxPossible->pm;
#						echo'<br/>';
					
						$arrMateriauxutilisePm[$oMateriauxPossible->id]=array();
						$arrMateriauxutilisePm[$oMateriauxPossible->id]['pm']=$oMateriauxPossible->pm;
						$arrMateriauxutilisePm[$oMateriauxPossible->id]['multi']=$multiplicateur;
						$arrMateriauxutilisePm[$oMateriauxPossible->id]['pmMulti']=$multiplicateur*$oMateriauxPossible->pm;
						//$arrMateriauxutilise[$oMateriauxPossible->id]['obj']=$oMateriauxPossible;
						if(is_numeric($arrMateriauxutilisePm[$oMateriauxPossible->id]['pmMulti'])){
							$this->pmTotal+=$arrMateriauxutilisePm[$oMateriauxPossible->id]['pmMulti'];
						}
						
						foreach($oMateriauxPossible->arrNombreOxyde as $idOxyde=>$nombreOxyde){
							$moleDeduite = $multiplicateur*$nombreOxyde;
							//$moleDeduite = $multiplicateur*$nombreOxyde;
#							echo'<hr/>Mole deduite '.$oMateriauxPossible->libelle.'<br/>';
#							echo'<br/>'.$moleDeduite.'<br/>';
#							echo$arrOxydeDemander[$idOxyde].'<br/>';
							
							
							$arrOxydeDemander[$idOxyde]-=$moleDeduite;
							
#							echo 'reste a trouver '.$arrOxydeDemander[$idOxyde].'<hr/>';
						}
					
					}

				}
			
	#			if($id==getParametreSite('KAOLIN_A_ID') && round($pourcentage)>=getParametreSite('KAOLIN_A_MAX')){
	#					
	#					
	#				
	#					$oMatKaoCalcine=ObjMateriaux::get(getParametreSite('KAOLIN_CALCINE_ID'));
	#					if(!$oMatKaoCalcine->pm){
	#						$oMatKaoCalcine->initPm();
	#					}
	#				}

				/*
				 * reequilibrage du kaolin a en kaolin calcine
				 *
				 */
				$idKaolinA = getParametreSite('KAOLIN_A_ID');
			
				if(array_key_exists($idKaolinA,$arrMateriauxutilisePm) && array_key_exists(getParametreSite('KAOLIN_CALCINE_ID'),$this->selectionMateriaux)){
					$pourcentageKaoAActuel=round(($arrMateriauxutilisePm[$idKaolinA]['pmMulti']/$this->pmTotal)*100);
				
					if($pourcentageKaoAActuel>getParametreSite('KAOLIN_A_MAX')){
						$mutliKaoAActuel= $arrMateriauxutilisePm[$idKaolinA]['multi'];
						$pmMultiKaoAActuel= $arrMateriauxutilisePm[$idKaolinA]['pmMulti'];
						$pmTotal = $this->pmTotal;
						$pmKaoA= $arrMateriauxutilisePm[$idKaolinA]['pm'];
					
						$idKaolinCalc = getParametreSite('KAOLIN_CALCINE_ID');
						$multiKaolinCalc =0.0;
						$oMatKaoCalcine=ObjMateriaux::get($idKaolinCalc);
						if(!$oMatKaoCalcine->pm){
							$oMatKaoCalcine->initPm();
						}
						$pmKaoCalc= $oMatKaoCalcine->pm;
						$pmMultiKaoCalcActuel =$pmKaoCalc*$multiKaolinCalc;
					
						$ok=false;
					
						while(!$ok):
						$pmTotal -= $pmMultiKaoAActuel;
						$pmTotal -= $pmMultiKaoCalcActuel;
					
						$mutliKaoAActuel -=0.01;
						$pmMultiKaoAActuel = $pmKaoA*$mutliKaoAActuel;
						$pmTotal += $pmMultiKaoAActuel;
					
						$multiKaolinCalc +=0.01;
						$pmMultiKaoCalcActuel = $pmKaoCalc*$multiKaolinCalc;
						$pmTotal += $pmMultiKaoCalcActuel;
					
						$pourcentage=round(($pmMultiKaoAActuel/$pmTotal)*100);
						if($pourcentage<=getParametreSite('KAOLIN_A_MAX')){
							$ok=true;
						}

					
					
					
						endwhile;
					
						$arrMateriauxutilisePm[$idKaolinA]['multi']=$mutliKaoAActuel;
						$arrMateriauxutilisePm[$idKaolinA]['pmMulti']=$pmMultiKaoAActuel;
						$arrMateriauxutilisePm[$idKaolinCalc]['multi']=$multiKaolinCalc;
						$arrMateriauxutilisePm[$idKaolinCalc]['pm']=$pmKaoCalc;
						$arrMateriauxutilisePm[$idKaolinCalc]['pmMulti']=$pmMultiKaoCalcActuel;
						$this->pmTotal=$pmTotal;
					
					}
				}
			
				foreach($arrMateriauxutilisePm as $id=>$arr){
					$pourcentage=($arr['pmMulti']/$this->pmTotal)*100;
					$arrRetour[$id]['pm']=$arr['pm'];
					$arrRetour[$id]['pmMulti']=$arr['pmMulti'];
					$arrRetour[$id]['multiplicateur']=$arr['multi'];
					$arrRetour[$id]['pourcentage']=$pourcentage;
				}
				$erreurOxyde='';
				$erreur=false;
				foreach($arrOxydeDemander as $idOxyde=>$v){
					if(round(@number_format($v,3),3)>0.001){
						$erreur=true;
						//$oOxyde = ObjOxyde::get($idOxyde);
						//$erreurOxyde .=' '.$oOxyde->formule.' ';
					}
				}
	#			//echo'<pre>';
	#			//var_dump($arrMateriauxutilisePm);
	#			//echo'</pre>';echo'<br/>';
				//var_dump($arrOxydeDemander);
				//var_dump(implode($arrOxydeDemander));
				
				
				if($erreur){
					$this->erreur='L\'algorithme n\'a pas reussi à resoudre la formule';
					//return false;
#					echo'<hr/><pre>';
#					var_dump($arrMateriaux);
#						echo'</pre>';
					$recetteTrouver=false;
				
				}else{
					$recetteTrouver=true;
				}
				
				
				//return $arrRetour;
			}else{
				//var_dump(implode($arrOxydeDemander));
				$this->erreur='L\'algorithme n\'a pas reussi à resoudre la formule';
			}
			//$recetteTrouver=false;
			//return false;
			if(!$recetteTrouver){
				if($firstBoucle){
					
					$arrMateriauxErreur = $arrRetour;
				}
				$firstBoucle = false;
				foreach ($arrMateriaux as $k=>$oMateriaux){
					if ($k==$keyFirstMat){
					
#						var_dump($k.'-'.$keyFirstMat);
						unset($arrMateriaux[$k]);
						
						
					}
				}
				//var_dump($arrMateriaux);
				//die('bas de la boucle');
			}
			//end While
		}
		if($recetteTrouver){
			$this->erreur="";
			$arrRetourOrdonne = array();
			foreach ($arrMateriaux as $oMateriaux){
				
				if(array_key_exists($oMateriaux->id,$arrRetour)){
					$arrRetourOrdonne[]=array($oMateriaux->id,$arrRetour[$oMateriaux->id]);
				}
			}
			
			return $arrRetourOrdonne;
		}else{
			//var_dump($arrMateriauxErreur);
			$arrRetourErreur = array();
			foreach($arrMateriauxErreur as $id=>$valeur){
				$arrRetourErreur[]=array($id,$valeur);
			}
			return $arrRetourErreur;
		}
		
	}
	
	public function ajusteKaolinA($pourcentActuel){
	
	}
}
?>
