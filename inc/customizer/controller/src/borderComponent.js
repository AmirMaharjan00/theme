const { ColorPicker, ColorIndicator, Dropdown, MenuItem, RangeControl, Tooltip, Dashicon } = wp.components;
const { useState, useEffect } = wp.element;
const { escapeHTML } = wp.escapeHtml;
const { __ } = wp.i18n;
const { customize } = wp;
import { PresetComponent, BlogmaticControlHeader, useBlogmaticColorPresets } from './component-function'

export const BlogmaticBorder = ( props ) =>  {
    const [ border, setBorder ] = useState( props.value )
    const [ type, setType ] = useState( border.type )
    const [ color, setColor ] = useState( border.color )
    const [ width, setWidth ] = useState( border.width )
    const { label, description, input_attrs: inputAttrs  } = customize.settings.controls[props.setting]
    const sides = [ 'top', 'right', 'bottom', 'left' ]
    
    const types = [ 'none', 'dotted', 'dashed', 'solid' ]

    const { isPreset, getColorsAndVariables } = useBlogmaticColorPresets( color )
    const allVariables = getColorsAndVariables()
    const activeColor = allVariables[color] === undefined ? color : allVariables[color]

    useEffect(() => {
        let newBorder = {
            type: type,
            color: color,
            width: width
        }
        setBorder( newBorder )
        customize.value( props.setting )( newBorder )
    },[ type ,color, width ] );

    const updateWidthStateOnChange = ( currentValue, side ) => {
        let widthObject
        if( width.link ) {
            widthObject = {
                ...width,
                'top': currentValue,
                'right': currentValue,
                'bottom': currentValue,
                'left': currentValue
            }
        } else {
            widthObject = { ...width, [side]: currentValue }
        }
        setWidth( widthObject )
    }

    /* Handle Type click */
    const handleTypeClick = ( _this, onToggle ) => {
        setType( _this )
        onToggle()
    }

    return (
        <div className={ `control-border-inner control-border-type-${type}`}>
            <div className="control-title-wrapper">
                <BlogmaticControlHeader label={ label } description={ description } />
                <div className="control-inner">
                    { <Dropdown
                        popoverProps = {{ resize:false, noArrow:false, flip:true, variant:"unstyled", placement:'bottom-end' }}
                        contentClassName = "blogmatic-border-control-popover"
                        renderToggle = {({ isOpen, onToggle }) => (
                            <div onClick={ onToggle } aria-expanded={ isOpen } >{ type }</div>
                        ) }
                        renderContent={({ onToggle }) => <div className='type-wrapper'>
                            { types.map(( current, index ) => <MenuItem key={ index } className={ 'type ' + current } onClick={() => handleTypeClick( current, onToggle )}>{ current === 'none' ? "None" : '' }</MenuItem>) }
                        </div>}
                    />}
                    { type !== 'none' && <Dropdown
                        popoverProps = {{ resize:false, noArrow:false, flip:true, variant:"unstyled", placement:'bottom-end' }}
                        contentClassName = "blogmatic-border-control-popover"
                        renderToggle = {({ isOpen, onToggle }) => (
                            <Tooltip placement="top" delay={200} text={ __( escapeHTML( 'Color' ), 'blogmatic-pro' ) }>
                                <span className={ "color-indicator-wrapper" + ( isPreset ? ' preset-isactive' : '') }>
                                    <ColorIndicator 
                                        className = { activeColor == null && "null-color" }
                                        colorValue = { activeColor }
                                        onClick = { onToggle }
                                        aria-expanded = { isOpen }
                                    />
                                </span>
                            </Tooltip>
                        ) }
                        renderContent={ () => <>
                            <div className="preset-colors">
                                <ul className="preset-colors-inner">
                                    <PresetComponent handlePresetClick={ setColor } color={ color } />
                                </ul>
                            </div>
                            <ColorPicker
                                color = { activeColor }
                                onChange = {( newColor ) => setColor( newColor )}
                                enableAlpha
                            />
                        </> }
                    />}
                </div>
            </div>
            { ( type != 'none' ) && <div className="field-wrap">
                <ul className={ width.link ? 'dimensions isactive' : 'dimensions not-active' }>
                    {
                        sides.map(( current, index ) => {
                            return <RangeControl
                                key = { index }
                                label = { current }
                                onChange = {( newValue ) => updateWidthStateOnChange( newValue, current )}
                                value = { ( typeof width == 'object' ) ? width[current] : 0 }
                                min = { inputAttrs.min }
                                max = { inputAttrs.max }
                                step = { inputAttrs.step }
                                resetFallbackValue = { width }
                                allowReset = { inputAttrs.reset }
                            />        
                        })
                    }
                    <div className='link-wrap' data-side={'link'} onClick={() => setWidth({ ...width, link: ( ! width.link ) } )}>
                        <label className='components-base-control__label'>{ __( 'Link', 'blogmatic-pro' ) }</label>
                        <Dashicon className='linked' icon="admin-links"/>
                    </div>
                </ul>
            </div> }
        </div>
    )
}