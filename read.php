		<?php 
			function get_news(){
				$dir="news";
				$files=scandir("$dir");
				$txt_files=array();
				foreach ($files as &$file){
					if(strlen($file)>3){
						if(strcmp(substr($file,-4),'.txt')==0){
							array_push($txt_files,"news/".$file);
						}
					}
				}

				$i=0;
				$j=0;
				$break=false;
				$short="";
				$long="";
				$news=array();
				foreach($txt_files as &$file){
					$content=file($file);

					foreach ($content as $line_num => $line) {
					    if($line_num==0){
					    	$date=$line;
					    }
					    if($line_num==1){
					    	$author=$line;
					    }
					    if($line_num==2){
					    	$title=$line;
					    }
					    if($line_num==3){
					    	$link=$line;
					    }
					    if(strcmp($line,"--\n")==0){
					    	$break=true;
					    	continue;
					    }
					    if($line_num>3 && !$break){
					    	$short.=$line."\n";
					    }
					    if($line_num>3 && $break){
					    	$long.=$line."\n";
					    }
					}
				array_push($news,array('date' => $date, 'author' => $author, 'title' => $title, 'link' => $link, 'short' => $short, 'long' => $long));
				}
				return $news;
			}
		
			$news=get_news();
			echo json_encode($news[$_GET['news_id']]);
		?>
	