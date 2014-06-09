var tmdSpecialities = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('type'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  remote: TypeaheadSearch.ajaxurl + '?action=typeaheadCallback&type=speciality&term=%QUERY'
});

var tmdProcedures = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('type'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  remote: TypeaheadSearch.ajaxurl + '?action=typeaheadCallback&type=procedure&term=%QUERY'
});

var tmdHospitals = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('type'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  remote: TypeaheadSearch.ajaxurl + '?action=typeaheadCallback&type=hospital&term=%QUERY'
});

tmdSpecialities.initialize();
tmdProcedures.initialize();
tmdHospitals.initialize();

jQuery(document).ready(function() {
	jQuery(TypeaheadSearch.fieldName)
		.typeahead(
			jQuery.extend({
				'hint': true,
	  			'highlight': true,
				'minLength': 1,
				}, TypeaheadSearch
			),
			{
			  name: 'tmd-specialities',
			  displayKey: 'type',
			  source: tmdSpecialities.ttAdapter(),
			  templates: {
			    header: '<h3 class="league-name">Specialities</h3>',
			    empty: [
			      '<div class="tt-empty-message">',
			      	'Unable to find any results',
			      '</div>'
			    ].join( '\n' ),
			    suggestion: Handlebars.compile( '<p><a href="{{url}}"><strong>{{title}}</strong></a></p>' )
			  }
			},
			{
			  name: 'tmd-procedures',
			  displayKey: 'type',
			  source: tmdProcedures.ttAdapter(),
			  templates: {
			    header: '<h3 class="league-name">Procedures</h3>',
			    empty: [
			      '<div class="tt-empty-message">',
			      	'Unable to find any results',
			      '</div>'
			    ].join( '\n' ),
			    suggestion: Handlebars.compile( '<p><a href="{{url}}"><strong>{{title}}</strong></a></p>' )
			  }
			},
			{
			  name: 'tmd-hospitals',
			  displayKey: 'type',
			  source: tmdHospitals.ttAdapter(),
			  templates: {
			    header: '<h3 class="league-name">Hospitals</h3>',
			    empty: [
			      '<div class="tt-empty-message">',
			      	'Unable to find any results',
			      '</div>'
			    ].join( '\n' ),
			    suggestion: Handlebars.compile( '<p><a href="{{url}}"><strong>{{title}}</strong></a></p>' )
			  }
			}
		);
});