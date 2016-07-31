<?php
	use app\views\widget\PaginationWidget;
?>

<div class="forumBody">
	<div class="forumBreadCrumds">
		<a href="/">Форум</a>
		<?php 
			$parentForums = $data["forum"]->getParentForums();	
			
			$countParentForums = count($parentForums);
			
			for ($i = 0; $i < $countParentForums; $i++)
				echo "<a href='/forum/?id=" . $parentForums[$i]->getAttr("id") . "'>" . $parentForums[$i]->getAttr("title") . "</a>";
		
			echo "<a href='/forum/?id=" . $data["forum"]->getAttr("id") . "'>" .  $data["forum"]->getAttr("title") . "</a>"; 
		?>
	</div>
	<div class="forumChildrens">
		<?php
			$countChildrens = count($data["childrens"]);
			
			for ($i = 0; $i < $countChildrens; $i++)
			{
				$lastPost[$i] = $data["childrens"][$i]->getLastPost();
				$lastPostAuthor[$i] = $lastPost[$i]->getAuthor();
				$lastPostTopic[$i] = $lastPost[$i]->getTopic();
				
				$childrenForums = $data["childrens"][$i]->getChildrenForums();
				
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
						<img class='forumIcon' src='" . $data["childrens"][$i]->getAttr("icon") . "'>
						<div class='forumTitle'>
							<a href='/forum/?id=" . $data["childrens"][$i]->getAttr("id") . "'>" . $data["childrens"][$i]->getAttr("title") . "</a>
							" . $childrenForumsDiv[$i] . "
						</div>
						<div class='forumCount'>Тем: " . $data["childrens"][$i]->getCountTopics() . "<br>Постов: " . $data["childrens"][$i]->getCountPosts() . "</div>
						<div class='forumLastPost'>
							<a href='/topic/?id=" . $lastPostTopic[$i]->getAttr("id") . "'>" . $lastPostTopic[$i]->getAttr("title") . "</a><br>
							<a href='/user/?id=" . $lastPostAuthor[$i]->getAttr("id") . "'>" . $lastPostAuthor[$i]->getAttr("login") . "</a><br>
							<a href='/topic/?id=" . $lastPostTopic[$i]->getAttr("id") . "&page=" . $lastPostTopic[$i]->getCountPages() . "#" . $lastPost[$i]->getAttr("id") . "'>" . $lastPost[$i]->getAttr("date_created") . "</a>
						</div>
					</div>
				";
			}
		?>
	</div>
	<div class="topics">
		<b>Темы:</b>
		<table class="topicsTable">
			<?php
				$countTopics = count($data["topics"]);
				
				for ($i = 0; $i < $countTopics; $i++)
				{
					$author[$i] = $data["topics"][$i]->getAuthor();
					$lastPost[$i] = $data["topics"][$i]->getLastPost();
					$lastPostAuthor[$i] = $lastPost[$i]->getAuthor();
					
					echo 
					"
						<tr>
							<td class='topicIcon'><a href='/user/?id=" . $author[$i]->getAttr("id") . "'><img src='" . $author[$i]->getAttr("avatar") . "'></a></td>
							<td class='topicTitle'>
								<a href='/topic/?id=" . $data["topics"][$i]->getAttr("id") . "'>" . $data["topics"][$i]->getAttr("title") . "<br>
								<a href='/user/?id=" . $author[$i]->getAttr("id") . "'>" . $author[$i]->getAttr("login") . "</a>,
								" . $data["topics"][$i]->getAttr("date_created") . "
							</td>
							<td class='topicCount'>Постов: " . $data["topics"][$i]->countPosts . "<br>Просмотров: " . $data["topics"][$i]->getAttr("views") . "</td>
							<td class='topicLastPost'>
								" . $lastPostAuthor[$i]->getAttr("login") . "<br>
								<a href='/topic/?id=" . $data["topics"][$i]->getAttr("id") . "&page=" . $data["topics"][$i]->getCountPages() . "#" . $lastPost[$i]->getAttr("id") . "'>" . $lastPost[$i]->getAttr("date_created") . "</a>
							</td>
						</tr>
					";
				}
			?>
		</table>
		<?php
			$pagination = new PaginationWidget($data["topics_pagin"], ["main" => "topicsPagin", "arrow" => "paginArrow"]);
		?>
	</div>
</div>