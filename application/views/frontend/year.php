<div class="survey_report">
 <div class="SR_heading">
    <h2>Pakistan Demographic & Health (PDHS) Survey</h2>
 </div>
 <div class="SR_content">
     <div class="SR_txt">
         <p>Demographic and Health Surveys (DHS) are nationally-representative household surveys that provide data for a wide range of monitoring and impact evaluation indicators in the areas of population, health, and nutrition. There are two main types of DHS Surveys:</p>
         <ul>
            <li>Standard DHS Surveys have large sample sizes (usually between 5,000 and 30,000 households) and typically are conducted about every 5 years, to allow comparisons over time.</li>
            <li>Interim DHS Surveys focus on the collection of information on key performance monitoring indicators but may not include data for all impact evaluation measures (such as mortality rates).</li>
         </ul>
         <p>Information is available for Anemia, Child Health, Domestic Voilence, Education, Family Planning, Fertility and fertility preferences, ..... <a href="">See more ...</a></p>
     </div>
     <div class="SR_yearsdata">Click on years to view the Analytical dashboard of PDHS Surveys</div>
 </div>
 <div class="SR_footer d-flex">
    <?php if($camp_years){
    foreach ($camp_years as $key => $year) {?>
     <div class="SR_footer_col border-right">
        <a href="<?php echo base_url();?>main/survey?subcomp-id=<?php echo $idsubcomponent;?>&year=<?php echo $year['name'];?>"><?php echo $year['name'];?></a>
    </div>
     <?php } }?>
</div>
</div>
