const { ColorPicker, ColorIndicator, Dropdown, Tooltip, TextControl, GradientPicker, Button, Dashicon, RadioControl } = wp.components;
const { useState, useEffect } = wp.element;
const { useDispatch } = wp.data
const { escapeHTML } = wp.escapeHtml;
const { __ } = wp.i18n;
const { customize } = wp;
import { blogmaticGenerateStyleTag, BlogmaticControlHeader } from './component-function'
import { store as myCustomStore } from './store';

export function BlogmaticPresetControl ( props ) {
    const [ value, setValue ] = useState( props.value )
    const { color_palettes: colorPalettes, active_palette: activePalette = '0' } = value
    const { label, description, blend } = customize.settings.controls[props.setting]
    const Variable = ( blend == 'solid' ) ? '--blogmatic-global-preset-color-' : '--blogmatic-global-preset-gradient-'
    const activePresetColors = colorPalettes[ activePalette ]
    const { setSolidColorPreset, setGradientColorPreset } = useDispatch( myCustomStore );

    useEffect(() => {
        // if( ! activePresetColors ) return
        // let styleReflector = activePresetColors.map(( current, index ) => {
        //     let count = index + 1
        //     return Variable + count + ':' + current
        // })
        // blogmaticGenerateStyleTag( props.setting, styleReflector.join(';') )
        customize.value( props.setting )( value )
        if( blend === 'solid' ) {
            setSolidColorPreset( activePresetColors )
        } else {
            setGradientColorPreset( activePresetColors )
        }
    }, [ value ])

    /**
     * update colors in palettes
     * 
     * @since 1.0.0
     */
    const updateColorIndexState = ( color, paletteItemIndex, paletteIndex ) => {
        let updatedValue = colorPalettes.map(( current, index ) => {
            if( index == paletteIndex ){
                return (
                    current.map(( _thisColor, colorItem ) => {
                        return ( colorItem == paletteItemIndex ) ? color : _thisColor
                    })
                )
            } else {
                return current
            }
        })
        setValue({ ...value, 'color_palettes': updatedValue })
    }

    /**
     * update number of items a single palette has
     * 
     * @since 1.0.0
     */
    const updatePaletteItemCount = ( palette, paletteIndex ) => {
        let updatedColorPalette = colorPalettes.map(( current, index ) => {
            return ( index === paletteIndex ) ? palette : current
        })
        setValue({ ...value, 'color_palettes': updatedColorPalette })
    }

    /**
     * update number of palettes
     * 
     * @since 1.0.0
     */
    const updatePaletteCount = () => {
        setValue({ ...value, 'color_palettes': [ ...colorPalettes, colorPalettes[ colorPalettes.length - 1 ] ] })
    }

    /**
     * Generate control options array
     */

    const optionsArray = () => {
        return colorPalettes.map(( currentItem, itemIndex ) => {
            return({ label: <div class="palette" key={itemIndex}>
                { currentItem.map(( color, index ) => {
                    return(<BlogmaticPresetRepeatable
                        key = { index }
                        currentColor = { color }
                        index = { index }
                        paletteIndex = { itemIndex }
                        originalValue = { colorPalettes }
                        updateColorIndexState = { updateColorIndexState }
                        removePresetColor = { updatePaletteItemCount }
                        blend = { blend }
                    />);
                }) }
                { ( colorPalettes.length > 1 ) && ( activePalette != itemIndex ) && <Button
                    className = "remove-from-list"
                    onClick = {() => setValue({ ...value, 'color_palettes': colorPalettes.filter(( current, _thisIndex ) => _thisIndex != itemIndex ) })}
                    >
                        { 'Remove' }
                    </Button> }
                <BlogmaticRepeaterComponent
                    repeatableComponent = { currentItem }
                    updateFunction = { updatePaletteItemCount }
                    index = { itemIndex }
                />
            </div>, value: itemIndex.toString() });
        })
    }

    // MARK: MAIN RETURN
    return (
        <div className="field-main">
            <BlogmaticControlHeader label={ label } description={ description } />
            <div className="field-wrap">
                <RadioControl
                    className = { 'blogmatic-radio-image' }
                    selected = { activePalette }
                    options = { optionsArray() }
                    onChange = {( item ) => setValue({ ...value, 'active_palette' : item })}
                />
            </div>
            <TextControl 
                id = { props.setting + '-reflector' }
                type = 'hidden'
                value = { activePresetColors.length }
            />
            <BlogmaticRepeaterComponent
                repeatableComponent = { colorPalettes }
                text = { __( 'Add new', 'blogmatic-pro' ) }
                updateFunction = { updatePaletteCount }
            />
        </div>
    );
}

/**
 * A repeater component that handles repeating the repeatable components
 * 
 * MARK: REPEATER COMPONENT
 * @params repeatable component
 * @since 1.0.0
 */
const BlogmaticRepeaterComponent = ({ repeatableComponent, text, updateFunction, index }) => {
    const [ repeatable, setRepeatable ] = useState( repeatableComponent )
    const [ isClicked, setIsClicked ] = useState( false )

    useEffect(() => {
        if( isClicked ) {
            if( updateFunction.length > 0 ) {
                updateFunction( repeatable, index )
            } else {
                updateFunction()
            }
        }
    }, [ repeatable ])

    /**
     * handle click event
     * 
     * @since 1.0.0
     */
    const handleClickEvent = () => {
        setRepeatable([ ...repeatableComponent, repeatableComponent[ repeatableComponent.length - 1 ] ])
        setIsClicked( true )
    }

    return (
        <Button
            className = "add-to-list" 
            variant = "primary"
            text = { text }
            isSmall = {true}
            icon = 'plus'
            onClick = {() => handleClickEvent() }
        />
    );
}

BlogmaticRepeaterComponent.defaultProps = {
    text: '',
    updateFunction: function(){},
    index: ''
}

/**
 * This is the component to repeat
 * 
 * MARK: PALETTE ITEMS COMPONENT
 * @since 1.0.0
 */
const BlogmaticPresetRepeatable = ({ currentColor, index, originalValue, updateColorIndexState, blend, paletteIndex, removePresetColor }) => {
    const ACTIVEPALETTE = originalValue[paletteIndex]

    const handleColorChange = ( newColor ) => {
        updateColorIndexState( newColor, index, paletteIndex )
    }

    return(
        <div className='item'>
            <Dropdown
                popoverProps = {{ resize:false, noArrow:false, flip:true, variant:"unstyled", placement:'bottom-end' }}
                contentClassName = "blogmatic-color-control-popover"
                renderToggle = { ( { isOpen, onToggle } ) => (
                    <Tooltip placement="top" delay={ 200 } text={ __( escapeHTML( 'Preset ' + ( index + 1 ) ), 'blogmatic-pro' ) }>
                        <span className="color-indicator-wrapper">
                            <ColorIndicator 
                                colorValue = { currentColor }
                                onClick = { onToggle }
                                aria-expanded = { isOpen }
                            />
                        </span>
                    </Tooltip>
                ) }
                renderContent={ () => 
                    <>
                        { blend == 'solid' ? <ColorPicker
                            color = { currentColor }
                            onChange = { ( newPreset ) => handleColorChange( newPreset ) }
                            enableAlpha
                        /> : <GradientPicker 
                            value = { currentColor }
                            onChange = { ( newPreset ) => handleColorChange( newPreset ) }
                            __nextHasNoMargin = { true }
                        /> }
                    </> 
                }
            />
            { ACTIVEPALETTE.length > 1 && <Dashicon
                className="remove-preset"
                icon="no-alt"
                onClick = {() => removePresetColor( ACTIVEPALETTE.filter(( colorItem, colorIndex ) => index !== colorIndex ), paletteIndex )}
            /> }
        </div>
    );
}
