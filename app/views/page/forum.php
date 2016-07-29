<div class="forumBody">
	<div class="forumBreadCrumds">
		<a href="/">Форум</a>
		<?php 
			if ($data["forum"]->getParentForum())
			{
				$parentForum = $data["forum"]->getParentForum();
				
				echo "<a href='/forum/?id=" . $parentForum["id"] . "'>" . $parentForum["title"]. "</a>";
			}	
		
			echo "<a href='/forum/?id=" . $data["forum"]->getAttr("id") . "'>" .  $data["forum"]->getAttr("title") . "</a>"; 
		?>
	</div>
	<div class="forumChildrens">
		<?php
			$childrens = $data["forum"]->getChildrenForums();

			$countChildrens = count($childrens);
			
			for ($i = 0; $i < $countChildrens; $i++)
			{
				$childrenForums = $childrens[$i]->getChildrenForums();
				
				$countChildrenForums = count($childrenForums);
				
				for ($j = 0; $j < $countChildrenForums; $j++)
				{
					if ($j == 0)
						$childrenForumsDiv[$i] .= "<ul class='childrenForums'>";
					
					$childrenForumsDiv[$i] .= "<li><a href='/forum/?id=" . $childrenForums[$j]->getAttr("id") . "'>" . $childrenForums[$j]->getAttr("title") . "</a></li>";
					
					if ($j == $countChildrenForums - 1)
						$childrenForumsDiv[$i] .= "</ul>";
				}

				echo 
				"
					<div class='forum'>
						<img class='forumIcon' src='" . $childrens[$i]->getAttr("icon") . "'>
						<div class='forumTitle'>
							<a href='/forum/?id=" . $childrens[$i]->getAttr("id") . "'>" . $childrens[$i]->getAttr("title") . "</a>
							" . $childrenForumsDiv[$i] . "
						</div>
						<div class='forumCount'>Тем: 10<br>Постов: 100</div>
						<div class='forumLastPost'>Последнее сообщение<br>27.07.2016 14:31</div>
					</div>
				";
			}
		?>
	</div>
</div>