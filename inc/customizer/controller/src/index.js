const { RadioControl, TabPanel, Card, CardBody, ToggleControl, ButtonGroup, Button, RangeControl, CheckboxControl, Dropdown, Tooltip, ColorIndicator, ColorPicker, Dashicon, GradientPicker } = wp.components;
const { createRoot, useState, useEffect, useMemo } = wp.element;
const { __ } = wp.i18n;
const { escapeHTML } = wp.escapeHtml;
const { customize } = wp;
const { useSelect, useDispatch } = wp.data
import { BlogmaticBorder } from './borderComponent'
import { BlogmaticTypography } from './typographyComponent'
import { BlogmaticBoxShadow } from './boxShadowComponent'
import { BlogmaticItemSort } from './sortComponent'
import { BlogmaticAsyncMultiselect, BlogmaticMultiselect } from './asyncMultiSelectControl'
import { BlogmaticSocialShare } from './socialShareComponent'
import { BlogmaticPresetControl } from './presetComponent'
import { BlogmaticColorComponent } from './colorComponent'
import { BlogmaticTypographyPreset } from './typographyPreset'
import { BlogmaticControlHeader, blogmaticReflectResponsiveInControl, blogmaticReflectResponsiveInCustomizer, BlogmaticGetResponsiveIcons } from './component-function'
import { BlogmaticHeaderBuilder } from './headerBuilder'
import { BlogmaticResponsiveBuilder } from './responsiveBuilder'
import { BlogmaticResponsiveRadioImage } from './responsiveRadioImage'
import { store as myCustomStore } from './store';

const BlogmaticUpsellWithPreview = ( props ) => {
    const CHOICES = customize.settings.controls[props.setting].choices

    return (
        <>
            { CHOICES &&
                CHOICES.map(( choice ) => {
                    return (
                        <div className={`upsell-inner-wrap ${(choice.classes) ? choice.classes : '' }`}>
                            <div class="button-icon">
                                { choice.icon && <i class={`up-icon ${choice.icon}`}></i> }
                                <Button className="upsell-button" href={ choice.url } target="__blank" variant="primary" text={ choice.label } isSmall={true}/>
                            </div>
                            { choice.preview_url && <img class="upsell-preview-frame" src={ choice.preview_url } /> }
                        </div>
                    )
                })
            }
        </>
    )
}

const BlogmaticInfoBox = ( props ) => {
    const { label, description, choices } = customize.settings.controls[props.setting]

    return (
        <>
            <BlogmaticControlHeader label={ label } description={ description } />
            { choices &&
                choices.map(( choice ) => {
                    return (
                        <Button className="info-box-button" href={ choice.url } target="__blank" variant="primary" text={ choice.label } isSmall={true}/>
                    )
                })
            }
        </>
    )
}

const BlogmaticInfoBoxAction = ( props ) => {
    const { label, description, choices } = customize.settings.controls[props.setting]
    return (
        <Card>
            <CardBody>
                <BlogmaticControlHeader label={ label } description={ description } />
                { choices &&
                    choices.map(function(choice, key) {
                        return (
                            <Button className="info-box-button" data-action={ choice.action } variant="primary" text={ choice.label } isSmall={true}/>
                        )
                    })
                }
            </CardBody>
        </Card>
    )
}

// Radio Tab control
const BlogmaticRadioTab = ( props ) => {
    const [ tab, setTab ] = useState( props.value )
    const { label, description, choices, double_line: doubleLine } = customize.settings.controls[props.setting]
    
    useEffect(() => {
        customize.value( props.setting )( tab )
    }, [tab])

    return(
        <div className={ 'radio-tab-wrapper' + ( doubleLine ? ' double-line' : '' ) }>
            <BlogmaticControlHeader label={ label } description={ description } />
            <ButtonGroup className="control-inner">
                { choices &&
                    choices.map( (choice) => {
                        const { value, label: tabLabel = '', icon } = choice
                        return(
                            <Button
                                variant = { tab === value ? 'primary' : 'secondary' }
                                onClick = {() => setTab( value )}
                                label = { icon ? tabLabel : '' }
                                showTooltip = { icon ? true : false }
                                className = { icon ? 'is-icon' : ''}
                                tooltipPosition = { 'top' }
                            >
                                { icon ? <Dashicon icon={ icon } /> : tabLabel }
                            </Button>
                        )
                    })
                }
            </ButtonGroup>
        </div>
    )
}

// Radio Image control
const BlogmaticRadioImage = ( props ) => {
    const [ value, setValue ] = useState( props.value )
    const { label, description, choices } = customize.settings.controls[props.setting]
    const [ filteredChoices, setFilteredChoices ] = useState([])
    
    useEffect(() => {
        customize.value( props.setting )( value )
    }, [value])

    useEffect(() => {
        let filtered = Object.entries( choices ).map(([ itemKey, itemValue ]) => {
            const { label, url } = itemValue
            return {
                label: <Tooltip placement="top" delay={200} text={ label } >
                        <img src={ url }/>
                    </Tooltip>,
                value: itemKey
            }
        })
        setFilteredChoices( filtered );
    }, [])

    return(
        <div className='radio-image-wrapper'>
            <BlogmaticControlHeader label={ label } description={ description } />
            <div className="control-inner">
                { choices && <RadioControl
                    selected = { value }
                    options = { filteredChoices }
                    onChange = {( newValue ) => setValue( newValue )}
                />}
            </div>
        </div>
    )
}

// Toggle Button control
const BlogmaticToggleButton = ( props ) =>  {
    const [ toggle, setToggle ] = useState(props.value)
    const { label, description } = customize.settings.controls[props.setting]

    const updateControl = ( newToggle ) => {
        setToggle( newToggle )
        customize.value( props.setting )(newToggle)
    }
    return (
        <Card elevation={2} isRounded={false} isBorderless={true} size="small">
            <CardBody>
                <ToggleControl
                    label = { label }
                    help = { toggle ? 'Currently enabled.' : 'Currently disabled.' }
                    checked={ toggle }
                    onChange={( newToggle ) => updateControl( newToggle )}
                />
                <BlogmaticControlHeader description={ description } />
            </CardBody>
        </Card>
    )
}

// Simple Toggle Button control
const BlogmaticSimpleToggleButton = ( props ) =>  {
    const [ toggle, setToggle ] = useState(props.value)

    const updateControl = ( newToggle ) => {
        setToggle( newToggle )
        customize.value( props.setting )(newToggle)
    }
    return (
        <ToggleControl
            label={ customize.settings.controls[props.setting].label }
            checked={ toggle }
            onChange={ (newToggle) => updateControl( newToggle ) }
        />
    )
}

// Checkbox control
const BlogmaticCheckbox = ( props ) =>  {
    const [ checkbox, setCheckbox ] = useState(props.value)
    const { label, description } = customize.settings.controls[props.setting]

    const updateControl = ( newCheckbox ) => {
        setCheckbox( newCheckbox )
        customize.value( props.setting )(newCheckbox)
    }
    return (
        <CheckboxControl
            label = { label }
            help ={ description }
            checked = { checkbox }
            onChange = {( newCheckbox ) => updateControl( newCheckbox )}
        />
    )
}

// section tab control
const BlogmaticSectionTab = (props) => {
    const { value, setting } = props
    const { choices } = customize.settings.controls[props.setting]

    useEffect (() => {
        onTabChange( value )
    })
    
    function onTabChange( tabName ) {
        var sectionName =  wp.customize.control( setting ).section()
        var controlsName = wp.customize.section( sectionName ).controls()
        controlsName.map(( current, index ) => {
            if( index > 0 ) {
                if( ! ( 'tab' in current.params ) ) current.params.tab = 'general'
                if( current.id == 'header_textcolor' ) current.params.tab = 'design'
                if( ! wp.customize.control( current.id ).active() ) return
                if( current.params.tab === tabName ) {
                    current.container[0].style.display = 'block'
                } else {
                    current.container[0].style.display = 'none'
                }
            }
        })
    }

    return(
        <TabPanel
            activeClass="active-tab"
            initialTabName={value}
            onSelect={ ( tabName => onTabChange(tabName) ) }
            tabs={ choices }
        >
            { ( tab ) => {
                return;
            }}
        </TabPanel>
    )
}

const BlogmaticSpacingControl = (props) => {
    const [ inputs, setInputs ] = useState( props.value )
    const [ activeResponsive, setActiveResponsive ] = useState('desktop')
    const { label, description, default: defaultValues, input_attrs: inputAttrs } = customize.settings.controls[props.setting]
    const DIMENSIONS = [ 'top', 'right', 'bottom', 'left' ]

    useEffect(() => {
        customize.value( props.setting )( inputs )
    }, [ inputs[activeResponsive].top, inputs[activeResponsive].left, inputs[activeResponsive].bottom, inputs[activeResponsive].right ] )

    useEffect(() => {
        blogmaticReflectResponsiveInControl( setActiveResponsive )
    },[])

    const handleClick = () => {
        setInputs({
            ...inputs,
            [activeResponsive]: {
                ...inputs[activeResponsive],
                'link': ( inputs[activeResponsive].link ? false : true )
            }
        })
    }

    const handleOnChange = ( newValue, side ) => {
        if( inputs[activeResponsive].link ){
            setInputs({
                ...inputs,
                [activeResponsive]: {
                    ...inputs[activeResponsive],
                    "top": newValue,
                    "right": newValue,
                    "bottom": newValue,
                    "left": newValue,
                }
            })
        } else {
            setInputs({
                ...inputs,
                [activeResponsive]: {
                    ...inputs[activeResponsive],
                    [side]: newValue
                }
            })
        }
    }

    const handleDashIconClick = ( type ) => {
        blogmaticReflectResponsiveInCustomizer( setActiveResponsive, type )
    }

    return (
        <div className='field-main'>
            <BlogmaticControlHeader label={ label } description={ description }>
                <BlogmaticGetResponsiveIcons responsive={ activeResponsive } stateToSet={ handleDashIconClick }>
                    <Dashicon className="reset-button" icon="image-rotate" onClick={() => { setInputs( defaultValues ) } }/>
                </BlogmaticGetResponsiveIcons>
            </BlogmaticControlHeader>
            <div className='field-wrap'>
                <ul className={'dimensions' + ( inputs[activeResponsive].link ? ' isactive' : ' not-active' ) }>
                    {
                        DIMENSIONS.map(( dimension ) => {
                            return <RangeControl
                                label = { dimension }
                                onChange = {( newValue ) => { handleOnChange( newValue, dimension ) }}
                                value = { inputs[ activeResponsive ][ dimension ] }
                                min = { inputAttrs.min }
                                max = { inputAttrs.max }
                                step = { inputAttrs.step }
                                resetFallbackValue = { props.value }
                                allowReset = { inputAttrs.reset }
                            />
                        })
                    }
                    <div className='link-wrap' onClick={ handleClick } data-side={'link'}>
                        <label className='components-base-control__label'>Link</label>                      
                        <Dashicon className='linked' icon="admin-links"/>
                    </div>
                </ul>
            </div>
        </div>
    );
}

const BlogmaticNumber = ( props ) => {
    const [ value, setValue ] = useState( props.value )
    const [ activeResponsive, setActiveResponsive ] = useState( 'desktop' )
    const { label, description, input_attrs: inputAttrs, responsive, default: defaulValue } = customize.settings.controls[props.setting]
    const { setHeaderFirstRow, setHeaderSecondRow, setHeaderThirdRow, setFooterFirstRow, setFooterSecondRow, setFooterThirdRow } = useDispatch( myCustomStore );

    useEffect(() => {
        customize.value( props.setting )( value )
        switch( props.setting ) {
            /* Header Count */
            case 'header_first_row_column' :
                setHeaderFirstRow( value )
                break;
            case 'header_second_row_column' :
                setHeaderSecondRow( value )
                break;
            case 'header_third_row_column' :
                setHeaderThirdRow( value )
                break;
            /* Footer Count */
            case 'footer_first_row_column' :
                setFooterFirstRow( value )
                break;
            case 'footer_second_row_column' :
                setFooterSecondRow( value )
                break;
            case 'footer_third_row_column' :
                setFooterThirdRow( value )
                break;
        }
    }, [ ( responsive ) ? value[activeResponsive] : value ] )

    useEffect(() => {
        blogmaticReflectResponsiveInControl( setActiveResponsive )
    }, [])

    // handle responsive icon click
    const handleDashIconClick = ( type ) => {
        blogmaticReflectResponsiveInCustomizer( setActiveResponsive, type )
    }

    return (
        <>
            <div className='field-main'>
                <BlogmaticControlHeader label={ label } description={ description }>
                    { responsive && <BlogmaticGetResponsiveIcons responsive={ activeResponsive } stateToSet={ handleDashIconClick } >
                        <Dashicon icon='image-rotate' className="reset-button" onClick={() => setValue( defaulValue )}/>
                    </BlogmaticGetResponsiveIcons> }
                </BlogmaticControlHeader>
                <RangeControl
                    onChange = { ( newValue ) => setValue( ( responsive ) ? { ...value, [activeResponsive]: newValue } : newValue ) }
                    value = { ( responsive ) ? value[activeResponsive] : value }
                    min = { inputAttrs.min }
                    max = { inputAttrs.max }
                    step = { inputAttrs.step }
                />
            </div>
        </>
    );
}

// Preset Color Picker control
const BlogmaticThemeColor = ( props ) =>  {
    const [ preset, setPreset ] = useState( props.value )
    const { default: defaultValue, involve, label } = customize.settings.controls[props.setting]

    const { setThemeColor, setGradientThemeColor } = useDispatch( myCustomStore )

    useEffect(() => {
        customize.value( props.setting )( preset )
        if( involve === 'solid' ) {
            setThemeColor( preset )
        } else {
            setGradientThemeColor( preset )
        }
    }, [preset])

    return (
        <div className="control-header">
            <div className="control-header-trigger">
                <BlogmaticControlHeader label={ label } />
                <Dashicon icon="image-rotate" className="reset-button components-button is-secondary is-small" onClick={() => setPreset( defaultValue ) } />
                <span className="control-content-wrap">
                    <Dropdown
                        popoverProps = {{ resize:false, noArrow:false, flip:true, variant:"unstyled", placement:'bottom-end' }}
                        contentClassName = "blogmatic-color-control-popover"
                        renderToggle = { ( { isOpen, onToggle } ) => (
                            <Tooltip placement="top" delay={200} text={ __( escapeHTML( 'Preset' ), 'blogmatic-pro' ) }>
                                <span className="color-indicator-wrapper">
                                    <ColorIndicator 
                                        colorValue = { preset }
                                        onClick = { onToggle }
                                        aria-expanded = { isOpen }
                                    />
                                </span>
                            </Tooltip>
                        ) }
                        renderContent={ () => <>
                            { involve === 'solid' ? <ColorPicker
                                color = { preset }
                                onChange = {( newPreset ) => setPreset( newPreset )}
                                enableAlpha
                            /> : <GradientPicker
                                value = { preset }
                                onChange = {( newPreset ) => setPreset( newPreset )}
                                __nextHasNoMargin = { true }
                                gradients = {[]}
                            /> }
                        </> }
                    />
                </span>
            </div>
        </div>
    )
}

const BlogmaticBuilderReflector = ( props ) => {
    const { placement, row, label, description, builder, responsive: responsiveBuilder, responsive_builder_id: responsiveBuilderId } = customize.settings.controls[props.setting]
    const [ responsive, setResponsive ] = useState( 'desktop' )

    useEffect(() => {
        blogmaticReflectResponsiveInControl( setResponsive )
    }, [])

    const reflectors = useSelect(( select ) => {
        return {
            /* Header builder reflector*/
            "header" : select( myCustomStore ).getHeaderBuilderReflector(),
            /* Footer builder reflector*/
            "footer" : select( myCustomStore ).getFooterBuilderReflector(),
            /* Responsive header builder reflector*/
            "responsive-header" : select( myCustomStore ).getResponsiveHeaderBuilderReflector()
        }
    }, []);

    /**
     * All widgets of a row
     * 
     * @since 1.0.0
     */
    const widgets = useMemo(() => {
        let builderValues
        if( responsive === 'desktop' ) {
            builderValues = reflectors[placement]
        } else {
            builderValues = ( responsiveBuilder !== null ) ? reflectors[responsiveBuilder] : reflectors[placement]
        }
        if( builderValues === null || builderValues === undefined ) return []
        if( Object.keys( builderValues ).length > 0 ) {
            const rowWidgets = builderValues[ row - 1 ]
            return Object.values( rowWidgets ).flatMap(( widget ) => widget )
        } else {
            return []
        }
    }, [ reflectors, responsive ])


    /**
     * Get instance of related builder using builder variable
     * 
     * @since 1.0.0
     */
    const builderWidgets = useMemo(() => {
        let activeBuilder
        if( responsive === 'desktop' ) {
            activeBuilder = builder
        } else {
            activeBuilder = ( responsiveBuilderId !== null ) ? responsiveBuilderId : builder
        }
        const sectionInstance = customize.control( activeBuilder ).params.widgets
        return sectionInstance
    }, [ responsive ])

    return <div className='field-main'>
        <BlogmaticControlHeader label={ label } description={ description } />
        <ul className='field-wrap'>
            {
                ( widgets.length > 0 ) ? 
                widgets.map(( widget, index ) => {
                    const { label: widgetLabel, section } = builderWidgets[widget]
                    return <li className='widget-reflector' key={ index } onClick={() => customize.section( section ).expand()}>
                        <span className='reflector-label'>{ widgetLabel }</span>
                        <Dashicon icon={ 'arrow-right-alt2' } />
                    </li>
                }) :
                <span className='no-widgets'>{ 'This row has no widgets.' }</span>
            }
        </ul>
    </div>
}

/**
 * Responsive Radio Tab control
 * 
 * @since 1.0.0
 */
const BlogmaticResponsiveRadioTab = ( props ) => {
    const [ tab, setTab ] = useState( props.value )
    const { label, description, choices, double_line: doubleLine, responsive: isResponsive } = customize.settings.controls[props.setting]
    const [ responsive, setResponsive ] = useState( 'desktop' )
    const _thisValue = isResponsive ? tab[responsive] : tab
    
    useEffect(() => {
        customize.value( props.setting )( tab )
    }, [ tab ])

    /**
     * Reflect the active responsive in our custom controls
     * 
     * @since 1.0.0
     */
    useEffect(() => {
        blogmaticReflectResponsiveInControl( setResponsive )
    }, [])

    /**
     * Handle responsive icons click
     * 
     * @since 1.0.0
     */
    const handleResponsiveIconsClick = ( type ) => {
        blogmaticReflectResponsiveInCustomizer( setResponsive, type )
    }

    /**
     * Handle button click
     * 
     * @since 1.0.0
     */
    const handleButtonClick = ( value ) => {
        if( isResponsive ) {
            setTab({ ...tab, [responsive]: value })
        } else {
            setTab( value )
        }
    }

    return(
        <div className={ 'radio-tab-wrapper' + ( doubleLine ? ' double-line' : '' ) }>
            <BlogmaticControlHeader label={ label } description={ description }>
                { isResponsive && <BlogmaticGetResponsiveIcons responsive={ responsive } stateToSet={ handleResponsiveIconsClick } /> }
            </BlogmaticControlHeader>
            <ButtonGroup className="control-inner">
                { choices &&
                    choices.map( (choice) => {
                        const { value, label: tabLabel = '', icon } = choice
                        return(
                            <Button
                                variant = { _thisValue === value ? 'primary' : 'secondary' }
                                onClick = {() => handleButtonClick( value )}
                                label = { icon ? tabLabel : '' }
                                showTooltip = { icon ? true : false }
                                className = { icon ? 'is-icon' : ''}
                                tooltipPosition = { 'top' }
                            >
                                { icon ? <Dashicon icon={ icon } /> : tabLabel }
                            </Button>
                        )
                    })
                }
            </ButtonGroup>
        </div>
    )
}

// Render components to html
customize.bind( 'ready', function () {

    let blogmaticControls = [
        'toggle-button', 'simple-toggle', 'radio-tab', 'checkbox', 'typography', 'box-shadow', 'section-tab',  'border', 'upsell', 'info-box', 'info-box-action', 'spacing', 'item-sortable', 'number-range', 'social-share', 'preset', 'color-field', 'async-multiselect', 'multiselect-normal', 'typography-preset', 'theme-color', 'builder', 'radio-image', 'builder-reflector', 'responsive-builder', 'responsive-radio-image', 'responsive-radio-tab'
    ]

    const getComponent = ( controlType, settingValue, setting ) => {
        if( controlType ) {
            switch( controlType ) {
                case 'toggle-button' :
                        return <BlogmaticToggleButton value={ settingValue } setting={ setting } />
                    break;
                case 'simple-toggle' :
                        return <BlogmaticSimpleToggleButton value={ settingValue } setting={ setting } />
                    break;
                case 'radio-tab' :
                        return <BlogmaticRadioTab value={ settingValue } setting={ setting } />
                    break;
                case 'checkbox' :
                        return <BlogmaticCheckbox value={ settingValue } setting={ setting } />
                    break;
                case 'typography' :
                        return <BlogmaticTypography value={ settingValue } setting={ setting } />
                    break;
                case 'typography-preset' :
                        return <BlogmaticTypographyPreset value={ settingValue } setting={ setting } />
                    break;
                case 'box-shadow' :
                        return <BlogmaticBoxShadow value={ settingValue } setting={ setting } />
                    break;
                case 'section-tab' :
                        return <BlogmaticSectionTab value={ settingValue } setting={ setting } />
                    break;
                case 'border' :
                        return <BlogmaticBorder value={ settingValue } setting={ setting } />
                    break;
                case 'upsell' :
                        return <BlogmaticUpsellWithPreview value={ settingValue } setting={ setting } />
                    break;
                case 'info-box' :
                        return <BlogmaticInfoBox value={ settingValue } setting={ setting } />
                    break;
                case 'info-box-action' :
                        return <BlogmaticInfoBoxAction value={ settingValue } setting={ setting } />
                    break;
                case 'spacing' :
                        return <BlogmaticSpacingControl value={ settingValue } setting={ setting } />
                    break;
                case 'item-sortable' :
                        return <BlogmaticItemSort value={ settingValue } setting={ setting } />
                    break;
                case 'number-range' :
                        return <BlogmaticNumber value={ settingValue } setting={ setting } />
                    break;
                case 'social-share' :
                        return <BlogmaticSocialShare value={ settingValue } setting={ setting } />
                    break;
                case 'preset' :
                        return <BlogmaticPresetControl value={ settingValue } setting={ setting } />
                    break;
                case 'color-field' :
                        return <BlogmaticColorComponent value={ settingValue } setting={ setting } />
                    break;
                case 'async-multiselect' :
                        return <BlogmaticAsyncMultiselect value={ settingValue } setting={ setting } />
                    break;
                case 'multiselect-normal' :
                        return <BlogmaticMultiselect value={ settingValue } setting={ setting } />
                    break;
                case 'theme-color' :
                        return <BlogmaticThemeColor value={ settingValue } setting={ setting } />
                    break;
                case 'builder' :
                    return <BlogmaticHeaderBuilder value={ settingValue } setting={ setting } />
                    break;
                case 'radio-image' :
                    return <BlogmaticRadioImage value={ settingValue } setting={ setting } />
                    break;
                case 'builder-reflector' :
                    return <BlogmaticBuilderReflector value={ settingValue } setting={ setting } />
                    break;
                case 'responsive-builder' :
                    return <BlogmaticResponsiveBuilder value={ settingValue } setting={ setting } />
                    break;
                case 'responsive-radio-image' :
                    return <BlogmaticResponsiveRadioImage value={ settingValue } setting={ setting } />
                    break;
                case 'responsive-radio-tab' :
                    return <BlogmaticResponsiveRadioTab value={ settingValue } setting={ setting } />
                    break;
            }
        }
    }
    
    blogmaticControls.map(( controlType ) => {
        const controls = document.getElementsByClassName( "customize-"+ controlType +"-control" )
        for( let control of controls ) {
            const setting = control.getAttribute( 'data-setting' );
            const settingValue =  customize.settings.settings[setting].value
            if( control ) {
                createRoot( control ).render( getComponent( controlType, settingValue, setting ) )
            }
        }
    })

    /* On Mobile options section expand show mobile view */
    customize.section('mobile_options_section').expanded.bind(function (isExpanded) {
        const footer = document.getElementById( "customize-footer-actions" )
        if( isExpanded ) {
            footer.getElementsByClassName( "preview-mobile" )[0].click()
        } else {
            footer.getElementsByClassName( "preview-desktop" )[0].click()
        }
    })
})