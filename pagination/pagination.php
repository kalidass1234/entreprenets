<?php

// show pagination
function pagination($url,$parameters,$pages,$current_page){
	 
							// pagination
							if($pages> 0): 
							
								$lastpage = $pages;		//lastpage is = total pages / items per page, rounded up.
								$lpm1 = $lastpage - 1;	
								$page = $current_page;
								$lpm1 = $pages - 1;	
								$adjacents = 3;

							
									$pagination = "";
									if($lastpage> 1)
									{	
										$pagination .= "<div class=\"pagination\">";
										
										// set preview page no
										if($current_page > 1)
											$prev = $current_page-1;
										else
											$prev = $current_page;
										
										// set next page no
										if($current_page < $lastpage)
											$next = $current_page+1;
										else
											$next = $current_page;	
											
										//previous button
										if ($page> 1) 
											$pagination.= "<a href=\"$url$parameters&page=1\">First</a><a href=\"$url$parameters&page=$prev\"> Prev</a>";
										else
											$pagination.= "<span class=\"disabled\"> First</span><span class=\"disabled\">Prev</span>";	
										
										//pages	
										if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
										{	
											for ($counter = 1; $counter <= $lastpage; $counter++)
											{
												if ($counter == $page)
													$pagination.= "<span><a style='background-color:#ccc;' id=\"current_$counter\" href=\"$url$parameters&page=$counter\">$counter</a></span>";
												else
													$pagination.= "<span><a id=\"current_$counter\" href=\"$url$parameters&page=$counter\" >$counter</a></span>";					
											}
										}
										elseif($lastpage> 5 + ($adjacents * 2))	//enough pages to hide some
										{
											//close to beginning; only hide later pages
											if($p < 1 + ($adjacents * 2))		
											{
												for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
												{
													if ($counter == $page)
														$pagination.= "<span><a style='background-color:#ccc;' id=\"current_$counter\" href=\"$url$parameters&page=$counter\" >$counter</a></span>";
													else
														$pagination.= "<span><a id=\"current_$counter\" href=\"$url$parameters&page=$counter\">$counter</a></span>";					
												}
												$pagination.= "...";
												$pagination.= "<span><a id=\"current_$lpm1\" href=\"$url$parameters&page=$lpm1\">$lpm1</a></span>";
												$pagination.= "<span><a id=\"current_$lastpage\" href=\"$url$parameters&page=$lastpage\">$lastpage</a></span>";		
											}
											//in middle; hide some front and some back
											elseif($lastpage - ($adjacents * 2)> $page && $page> ($adjacents * 2))
											{
												$pagination.= "<span><a id=\"current_1\" href=\"$url$parameters&page=1\" >1</a></span>";
												$pagination.= "<span><a id=\"current_2\" href=\"$url$parameters&page=2\" >2</a></span>";
												$pagination.= "...";
												for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
												{
													if ($counter == $page)
														$pagination.= "<span><a style='background-color:#ccc;' id=\"current_$counter\" href=\"$url$parameters&page=$counter\">$counter</a></span>";
													else
														$pagination.= "<span><a id=\"current_$counter\" href=\"$url$parameters&page=$counter\" >$counter</a></span>";					
												}
												$pagination.= "...";
												$pagination.= "<span><a id=\"current_$lpm1\" href=\"$url$parameters&page=$lpm1\" >$lpm1</a></span>";
												$pagination.= "<span><a id=\"current_$lastpage\" href=\"$url$parameters&page=$lastpage\" >$lastpage</a></span>";		
											}
											//close to end; only hide early pages
											else
											{
												$pagination.= "<span><a id=\"current_1\" href=\"$url$parameters&page=1\">1</a></span>";
												$pagination.= "<span><a  id=\"current_2\" href=\"$url$parameters&page=2\">2</a></span>";
												$pagination.= "...";
												for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
												{
													if ($counter == $page)
														$pagination.= "<span><a style='background-color:#ccc;' id=\"current_$counter\" href=\"$url$parameters&page=$counter\" >$counter</a></span>";
													else
														$pagination.= "<span><a id=\"current_$counter\" href=\"$url$parameters&page=$counter\" >$counter</a></span>";					
												}
											}
										}
										
										//next button
										if ($page < $counter - 1) 
											$pagination.= "<a href=\"$url$parameters&page=$next\" >Next</a><a href=\"$url$parameters&page=$lastpage\" >Last </a>";
										else
											$pagination.= "<span class=\"disabled\">Next</span><span class=\"disabled\">Last </span>";
										$pagination.= "</div>\n";		
										//<span style=\"float:right;font-weight:bold;\">Total Page : $pages</span>
									}
								
								return $pagination;
						endif; 
}
?>
