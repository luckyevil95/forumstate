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
						<div class='forumCount'>Тем: 10<br>Постов: 100</div>
						<div class='forumLastPost'>Последнее сообщение<br>27.07.2016 14:31</div>
					</div>
				";
			}		
			
			echo "</div>";
		}
	?>
</div>