var PdPortfolioViewerBlock = {

	toggleCategory:function(elem) {
		var contents = elem.parent('div.ccm-portfolio-item-title').next().toggle();
		if(contents.is(':visible')) {
			elem.parent('div.ccm-portfolio-item-title').find('a.ccm-portfolio-item-title-img').addClass('ccm-portfolio-item-title-img-down');
		} else {
			elem.parent('div.ccm-portfolio-item-title').find('a.ccm-portfolio-item-title-img').removeClass('ccm-portfolio-item-title-img-down');
		}
		
	},
	
	removeCategory:function(elem) {
		if(confirm(ccm_t('remove-category'))) {
			elem.closest('.ccm-portfolio-item-container').remove();
		}	
	}
}

function ccmValidateBlockForm() {
	$("input.item").each(function(){
		console.log(this);
		if($(this).attr("name").indexOf("title_") != -1 && $(this).val() == ""){
			ccm_addError(ccm_t('title-required'));
		}
		if($(this).attr("name").indexOf("category_") != -1 && $(this).val() == ""){
			ccm_addError(ccm_t('category-required'));
		}
	});
	if($("#items").val() == ""){
		ccm_addError(ccm_t('items-required'));
	}
	if(isNaN($("#items").val())){
		ccm_addError(ccm_t('items-numeric'));
	}
	if($("#thumbwidth").val() == "" || $("#thumbheight").val() == ""){
		ccm_addError(ccm_t('thumbsize-required'));
	}
	if(isNaN($("#thumbwidth").val())|| isNaN($("#thumbheight").val())){
		ccm_addError(ccm_t('thumbsize-numeric'));
	}
	if($("#largewidth").val() == ""){
		ccm_addError(ccm_t('largewidth-required'));
	}
	if(isNaN($("#largewidth").val())){
		ccm_addError(ccm_t('largewidth-numeric'));
	}
	return false;
}