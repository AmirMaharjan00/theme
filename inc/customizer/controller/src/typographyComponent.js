const { Dropdown, RangeControl, Dashicon, Tooltip, RadioControl, TabPanel } = wp.components;
const { escapeHTML } = wp.escapeHtml;
const { __ } = wp.i18n;
const { useState, useEffect } = wp.element;
const { customize } = wp;
import Select from 'react-select'
import GoogleFonts from '../googleFonts.json'
import { blogmaticReflectResponsiveInControl, blogmaticReflectResponsiveInCustomizer, BlogmaticControlHeader, BlogmaticGetResponsiveIcons } from './component-function'
import { store as myCustomStore } from './store';
const { useSelect } = wp.data

export const BlogmaticTypography = (props) => {
    const [ typography, setTypography ] = useState(props.value)
    const [ activePreset, setActivePreset ] = useState( typography.preset || '-1' )
    const { label, description, default: defaultValue } = customize.settings.controls[props.setting]
    const [ responsive, setResponsive ] = useState('desktop')
    
    useEffect(() => {
        customize.value( props.setting )({ ...typography, preset: activePreset })
    }, [ typography, activePreset ])

    /**
     * Update the typography state
     * 
     * @since 1.0.0
     */
    const updateTypographyState = ( property, val, reset = false ) => {
        const responsiveProperties = [ 'font_size', 'line_height', 'letter_spacing' ]
        let updatedTypography = {}
        if( responsiveProperties.includes( property ) && ! reset ) {
            updatedTypography = { ...typography, [property]: { ...typography[property], [responsive]: val } }
        } else {
            updatedTypography = { ...typography, [property]: val }
        }
        setTypography( updatedTypography )
        setActivePreset( '-1' )
    }

    /* Handle main reset button click */
    const handleMainReseetButtonClick = () => {
        setTypography( defaultValue )
        setActivePreset( '-1' )
    }

    return (
        <>
            <BlogmaticControlHeader label={ label } description={ description } />
            <Dashicon className="reset-button components-button is-secondary is-small" icon="image-rotate" onClick={ handleMainReseetButtonClick } />
            { activePreset !== '-1' && <span className='preset-indicator-wrapper'></span> }
            <TypographyComponent 
                value = { typography }
                updateTypography = { updateTypographyState }
                defaultValue = { defaultValue }
                setResponsive = { setResponsive }
                responsive = { responsive }
                setActivePreset = { setActivePreset }
            />
        </>
    )
}

const FontFamilyArray = () => {
    let families = []
    if( GoogleFonts ) {
        families = Object.keys(GoogleFonts).map( font => {
            return({ value: font, label: font })
        })
    }
   return(families)
}

const FontWeightsArray = ( family ) => {
    const italicVariant = GoogleFonts[family.value].variants.italic
    const normalVariant = GoogleFonts[family.value].variants.normal
    let italicOptions = [], normalOptions = []
    if( normalVariant ) {
        let label = "Regular 400"
        normalOptions = Object.keys( normalVariant ).map( weight => {
           switch( weight ) {
            case '100' :
                label = "Thin 100"
                break;
            case '200' :
                label = "ExtraLight 200"
                break;``
            case '300' :
                label = "Light 300"
                break;
            case '400' :
                label = "Regular 400"
                break;
            case '500' :
                label = "Medium 500"
                break;
            case '600' :
                label = "SemiBold 600"
                break;
            case '700' :
                label = "Bold 700"
                break;
            case '800' :
                label = "ExtraBold 800"
                break;
            case '900' :
                label = "Black 900"
                break;
            default :
                label = weight
                break;
           }
            return({ value: weight, label: label, variant: 'normal' })
        })
    }

    if( italicVariant ) {
        let label = "Regular 400"
        italicOptions = Object.keys( italicVariant ).map( weight => {
            switch( weight ) {
                case '100' :
                    label = "Thin 100 Italic"
                    break;
                case '200' :
                    label = "ExtraLight 200 Italic"
                    break;
                case '300' :
                    label = "Light 300 Italic"
                    break;
                case '400' :
                    label = "Regular 400 Italic"
                    break;
                case '500' :
                    label = "Medium 500 Italic"
                    break;
                case '600' :
                    label = "SemiBold 600 Italic"
                    break;
                case '700' :
                    label = "Bold 700 Italic"
                    break;
                case '800' :
                    label = "ExtraBold 800 Italic"
                    break;
                case '900' :
                    label = "Black 900 Italic"
                    break;
                default :
                    label = weight
                    break;
            }
            return({ value: weight, label: label, variant: 'italic' })
        })
    }
    
    return [
        [ ...normalOptions, ...italicOptions ],
        [
            { label: 'Normal', options: Object.values( normalOptions ) },
            { label: 'Italic', options: Object.values( italicOptions ) }
        ]
    ]
}

export const TypographyComponent = ({ value, defaultValue, responsive, isPreset, presetIndex, ...props }) => {
    const { font_family: fontFamily, font_weight: fontWeight, font_size: fontSize, preset } = value

    const typographyPresets = useSelect(( select ) => {
        return select( myCustomStore ).getTypographyPreset()
    }, []);

    /**
     * Generate control options array
     */
    const optionsArray = () => {
        const { typographies, labels } = typographyPresets
        return(
            labels.map(( _thisLabel, index ) => {
                const { font_family, font_size, font_weight } = typographies[ index ]
                let style = {
                    fontFamily: font_family.label,
                    fontSize: font_size[ responsive ] + 'px',
                    fontWeight: font_weight.value,
                    fontStyle: font_weight.variant,
                }
                return {
                    label: <h2 style={ style }>{ _thisLabel }</h2>,
                    value: index.toString()
                }
            })
        );
    }

    return(
        <>
            <Dropdown
                popoverProps = {{ resize:true, noArrow:false, flip:true, variant:"unstyled", placement:'bottom' }}
                contentClassName = "blogmatic-typography-popover"
                renderToggle = { ( { isOpen, onToggle } ) => (
                    <div className="typo-value-holder">
                        <div className="typo-summ-value" onClick={ onToggle } aria-expanded={ isOpen }>
                            <div className="summ-vals">
                                <span className="summ-val">{ fontFamily.label }</span><i>/</i>
                                <span className="summ-val">{ `${fontSize[responsive]}px` }</span><i>/</i>
                                <span className="summ-val">{ fontWeight.label }</span>
                            </div>
                            <span className="append-icon dashicons dashicons-ellipsis"></span>
                        </div>
                    </div>
                )}
                renderContent = { () => {
                    if( isPreset ) {
                        return <TypographyInnerControls
                            typography = { value }
                            defaultValue = { defaultValue }
                            isPreset = { isPreset }
                            updateTypography = { props.updateTypography }
                            presetIndex = { presetIndex }
                            responsive = { responsive }
                        />
                    } else {
                        return <TabPanel
                            activeClass = "active-tab"
                            initialTabName = { preset === '-1' ? 'custom' : 'preset' }
                            tabs = {[
                                { name: 'custom', title: 'Custom' },
                                { name: 'preset', title: 'Preset' }
                            ]}
                        >
                            { ( tab ) => {
                                switch( tab.name ){
                                    case 'preset' :
                                        return <RadioControl 
                                            className = { 'blogmatic-radio-image' }
                                            selected = { preset }
                                            options = { optionsArray() }
                                            onChange = {( value ) => props.setActivePreset( value )}
                                        />
                                        break;
                                    case 'custom' :
                                        return <TypographyInnerControls
                                            typography = { value }
                                            defaultValue = { defaultValue }
                                            isPreset = { isPreset }
                                            updateTypography = { props.updateTypography }
                                            presetIndex = { presetIndex }
                                            responsive = { responsive }
                                            setResponsive = { props.setResponsive }
                                        />
                                        break;
                                }
                            }}
                        </TabPanel>
                    }
                }}
            />
        </>
    )
}

TypographyComponent.defaultProps = {
    preset : '-1',
    defaultValue: null,
    isPreset: false,
    presetIndex: null
}

/**
 * Typography inner controls
 * 
 * @since 1.0.0
 */
const TypographyInnerControls = ( props ) => {
    const { typography, defaultValue, isPreset, presetIndex = null, responsive } = props
    const { font_family: fontFamily, font_weight: fontWeight, font_size: fontSize, line_height: lineHeight, letter_spacing: letterSpacing, text_transform: textTransform, text_decoration: textDecoration, preset = '-1' } = typography
    const [ fontFamilies, setFontFamilies ] = useState( [] )
    const [ fontWeights, setFontWeights ] = useState( [] )

    useEffect(() => {
        const fonts = FontFamilyArray()
        setFontFamilies(fonts)
    },[])

    useEffect(() => {
        let weights = FontWeightsArray( fontFamily )
        var data = weights[0].find(( ele ) => {
            return ( ele.value === fontWeight.value && ele.variant === fontWeight.variant );
        });
        if( ! data ) {
            updateTypography( 'font_weight', weights[0][0] )
        }
        setFontWeights( weights[1] )
    }, [ fontFamily ])

    /**
     * Update typography
     * 
     * @since 1.0.0
     */
    const updateTypography = ( property, val, reset = false ) => {
        if( isPreset ) {
            props.updateTypography( property, val, reset, presetIndex )
        } else {
            props.updateTypography( property, val, reset )
        }
    }

    const updateIcon = (newIcon) => {
        blogmaticReflectResponsiveInCustomizer( props.setResponsive, newIcon )
    }

    useEffect(() => {
        blogmaticReflectResponsiveInControl( props.setResponsive )
    }, [])

    return <ul className="typo-fields">
        <li className="typo-field">
            <Select
                className = "inner-field font-family"
                inputId = "blogmatic-search-in-select"
                isSearchable  = { true }
                value = { fontFamily }
                placeholder = { __( escapeHTML( 'Search . .' ), 'blogmatic-pro' ) }
                options = { fontFamilies }
                onChange = { ( newFont ) => updateTypography( 'font_family', newFont ) }
            />
        </li>
        <li className="typo-field">
            <Select
                className = "inner-field font-weight"
                inputId = "blogmatic-search-in-select"
                isSearchable  = { false }
                value = { fontWeight }
                options = { fontWeights }
                onChange = { ( newWeight ) => updateTypography( 'font_weight', newWeight ) }
                getOptionValue={(option) => option.label }
            />
        </li>
        <li className="typo-field">
            <Dashicon icon='image-rotate' className="reset-button" onClick={() => updateTypography( 'font_size', defaultValue.font_size, true )}/>
            <BlogmaticGetResponsiveIcons responsive={ responsive } stateToSet={ updateIcon }/>
            <RangeControl
                label = { __( escapeHTML( 'Font Size (px)' ), 'blogmatic-pro' ) }
                value = { fontSize[responsive] }
                onChange = { ( newRange ) => updateTypography( 'font_size', newRange ) }
                min = { 1 }
                max = { 100 }
                step = { 1 }
            />
        </li>
        <li className="typo-field">
            <Dashicon icon='image-rotate' className="reset-button" onClick={() => updateTypography( 'line_height', defaultValue.line_height, true )}/>
            <BlogmaticGetResponsiveIcons responsive={ responsive } stateToSet={ updateIcon }/>
            <RangeControl
                label = { __( escapeHTML( 'Line Height (px)' ), 'blogmatic-pro' ) }
                value = { lineHeight[responsive] }
                onChange = { ( newRange ) => updateTypography( 'line_height', newRange ) }
                min = { 1 }
                max = { 100 }
                step = { 1 }
            />
        </li>
        <li className="typo-field">
            <Dashicon icon='image-rotate' className="reset-button" onClick={() => updateTypography( 'letter_spacing', defaultValue.letter_spacing, true )}/>
            <BlogmaticGetResponsiveIcons responsive={ responsive } stateToSet={ updateIcon }/>
            <RangeControl
                label = { __( escapeHTML( 'Letter Spacing (px)' ), 'blogmatic-pro' ) }
                value = { letterSpacing[responsive] }
                onChange = { ( newRange ) => updateTypography( 'letter_spacing', newRange ) }
                min = { 0 }
                max = { 5 }
                step = { 0.1 }
            />
        </li>
        <li className="typo-field field-group">
            <div className="inner-field text-transform">
                <Tooltip placement="top" delay={200} text={ __( escapeHTML( 'Unset' ), 'blogmatic-pro' ) }><span className={ ( textTransform == 'unset' ) && 'isActive' } onClick={ () => updateTypography( 'text_transform', 'unset') }>N</span></Tooltip>
                <Tooltip placement="top" delay={200} text={ __( escapeHTML( 'Capitalize' ), 'blogmatic-pro' ) }><span className={ ( textTransform == 'capitalize' ) && 'isActive' } onClick={ () => updateTypography( 'text_transform', 'capitalize') }>Aa</span></Tooltip>
                <Tooltip placement="top" delay={200} text={ __( escapeHTML( 'Uppercase' ), 'blogmatic-pro' ) }><span className={ ( textTransform == 'uppercase' ) && 'isActive' } onClick={ () => updateTypography( 'text_transform', 'uppercase') }>AA</span></Tooltip>
                <Tooltip placement="top" delay={200} text={ __( escapeHTML( 'Lowercase' ), 'blogmatic-pro' ) }><span className={ ( textTransform == 'lowercase' ) && 'isActive' } onClick={ () => updateTypography( 'text_transform', 'lowercase') }>aa</span></Tooltip>
            </div>
            <div className="inner-field text-decoration">
                <Tooltip placement="top" delay={200} text={ __( escapeHTML( 'None' ), 'blogmatic-pro' ) }><span className={ ( textDecoration == 'none' ) && 'isActive' } onClick={ () => updateTypography( 'text_decoration', 'none') }>Aa</span></Tooltip>
                <Tooltip placement="top" delay={200} text={ __( escapeHTML( 'Line Through' ), 'blogmatic-pro' ) }><span className={ ( textDecoration == 'line-through' ) && 'isActive' } onClick={ () => updateTypography( 'text_decoration', 'line-through') }><strike>Aa</strike></span></Tooltip>
                <Tooltip placement="top" delay={200} text={ __( escapeHTML( 'Underline' ), 'blogmatic-pro' ) }><span className={ ( textDecoration == 'underline' ) && 'isActive' } onClick={ () => updateTypography( 'text_decoration', 'underline') }><u>Aa</u></span></Tooltip>
            </div>
        </li>
        <Tooltip id="blogmatic-control-tooltip"/>
    </ul>
}