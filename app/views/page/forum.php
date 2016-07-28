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
			$countChildrens = count($data["childrens"]);
			
			for ($i = 0; $i < $countChildrens; $i++)
			{
				echo 
				"
					<div class='forum'>
						<img class='forumIcon' src='" . $data["childrens"][$i]->getAttr("icon") . "'>
						<div class='forumTitle'>
							<a href='/forum/?id=" . $data["childrens"][$i]->getAttr("id") . "'>" . $data["childrens"][$i]->getAttr("title") . "</a>
						</div>
						<div class='forumCount'>Тем: 10<br>Постов: 100</div>
						<div class='forumLastPost'>Последнее сообщение<br>27.07.2016 14:31</div>
					</div>
				";
			}
		?>
	</div>
</div>