@inject('exhibitService', 'App\Services\Web\ExhibitService')
<div class="container" id="srm">
    <div class="row">
        <div class="col-md-12">
            <h3 class="headline centered margin-top-75">
                <strong class="headline-with-separator">{{ __('components.views.srm.h3.title') }}</strong>
            </h3>
        </div>
        <div class="col-md-12">
            <div id="chartdiv"></div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/amcharts/index.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/amcharts/hierarchy.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/amcharts/themes/Animated.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    var root = am5.Root.new("chartdiv");
    root.setThemes([
        am5themes_Animated.new(root)
    ]);

    // Create wrapper container
    var container = root.container.children.push(am5.Container.new(root, {
        width: am5.percent(100),
        height: am5.percent(100),
        layout: root.verticalLayout,
    }));

    // Create series
    var series = container.children.push(am5hierarchy.Pack.new(root, {
        singleBranchOnly: false,
        downDepth: 1,
        initialDepth: 10,
        valueField: "value",
        categoryField: "name",
        childDataField: "children",
        tooltip: am5.Tooltip.new(root, {
            labelHTML: "<div style='min-width:10px'><a href='{link}'><u><h3>{title}</h3></u></a></div>"
        })
    }));
    series.labels.template.setAll({
        fontSize: 20,
        fill: am5.color(0x550000),
        text: "",
        html: "<a href='{link}'></a>"
    });

    var database = JSON.parse('{!! $exhibitService::getSRM()->toJson() !!}');
    series.data.setAll([database]);
    series.set("selectedDataItem", series.dataItems[0]);

    // Make stuff animate on load
    series.appear(1000, 100);
</script>
@endpush
