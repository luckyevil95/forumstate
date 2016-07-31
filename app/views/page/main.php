<div class="forumCategories">
	<?php 
		$countCategories = count($data["categories"]);

		for ($i = 0; $i < $countCategories; $i++)
		{
			echo 
			"
				<div class='forumCategory'>
					<div class='forumCategoryTitle'>" . $data["categories"][$i]["title"] . "</div>
			";
			
			$countForums = count($data["forums"][$i]);
			
			for ($j = 0; $j < $countForums; $j++)
			{
				$lastPost[$j] = $data["forums"][$i][$j]->getLastPost();
				$lastPostAuthor[$j] = $lastPost[$j]->getAuthor();
				$lastPostTopic[$j] = $lastPost[$j]->getTopic();
				
				$childrenForums = $data["forums"][$i][$j]->getChildrenForums();
				
				$countChildrenForums = count($childrenForums);
				
				for ($k = 0; $k < $countChildrenForums; $k++)
				{
					if ($k == 0)
						$childrenForumsDiv[$i][$j] .= "<ul class='childrenForums'>";
					
					$childrenForumsDiv[$i][$j] .= "<li><a href='/forum/?id=" . $childrenForums[$k]->getAttr("id") . "'>" . $childrenForums[$k]->getAttr("title") . "</a></li>";
					
					if ($k == $countChildrenForums - 1)
						$childrenForumsDiv[$i][$j] .= "</ul>";
				}
					
				
				echo 
				"
					<div class='forum'>
						<img class='forumIcon' src='" . $data["forums"][$i][$j]->getAttr("icon") . "'>
						<div class='forumTitle'>
							<a href='/forum/?id=" . $data["forums"][$i][$j]->getAttr("id") . "'>" . $data["forums"][$i][$j]->getAttr("title") . "</a>
							" . $childrenForumsDiv[$i][$j] . "
						</div>
						<div class='forumCount'>Тем: " . $data["forums"][$i][$j]->getCountTopics() . "<br>Постов: " . $data["forums"][$i][$j]->getCountPosts() . "</div>
						<div class='forumLastPost'>
							<a href='/topic/?id=" . $data["forums"][$i][$j]->getAttr("id") . "'>" . $lastPostTopic[$j]->getAttr("title") . "</a><br>
							<a href='/user/?id=" . $lastPostAuthor[$j]->getAttr("id") . "'>" . $lastPostAuthor[$j]->getAttr("login") . "</a><br>
							<a href='/topic/?id=" . $data["forums"][$i][$j]->getAttr("id") . "&page=" . $lastPostTopic[$j]->getCountPages() . "#" . $lastPost[$j]->getAttr("id") . "'>" . $lastPost[$j]->getAttr("date_created") . "</a>
						</div>
					</div>
				";
			}		
			
			echo "</div>";
		}
	?>
</div>