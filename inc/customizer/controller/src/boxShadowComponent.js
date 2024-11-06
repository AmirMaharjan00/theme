const { Dropdown, RangeControl, ColorIndicator, ColorPicker, ButtonGroup, Button, Tooltip, ToggleControl, Dashicon } = wp.components;
const { escapeHTML } = wp.escapeHtml;
const { __ } = wp.i18n;
const { useState, useEffect } = wp.element;
const { customize } = wp;
import { PresetComponent, BlogmaticControlHeader, useBlogmaticColorPresets } from './component-function'

export const BlogmaticBoxShadow = ( props ) => {
    const [ boxShadow, setBoxShadow ] = useState( props.value )
    const { hoffset, voffset, blur, spread, type, color, option } = boxShadow
    const { label, description, default: defaultValue } = customize.settings.controls[props.setting]
    const { isPreset, getColorsAndVariables } = useBlogmaticColorPresets( color )
    const allVariables = getColorsAndVariables()
    const activeColor = allVariables[color] === undefined ? color : allVariables[color]

    const rangeControlObject = {
        'hoffset' : __( escapeHTML( 'Horizontal Offset (px)' ), 'blogmatic-pro' ),
        'voffset' : __( escapeHTML( 'Vertical Offset (px)' ), 'blogmatic-pro' ),
        'blur' : __( escapeHTML( 'Blur (px)' ), 'blogmatic-pro' ),
        'spread' : __( escapeHTML( 'Spread (px)' ), 'blogmatic-pro' )
    }

    useEffect(() => {
        customize.value( props.setting )( boxShadow )
    },[ boxShadow ])

    /**
     * Handle Preset Color click
     * 
     * @since 1.0.0
     */
    const handlePresetColorClick = ( preset ) => {
        updateBoxShadowState( 'color', preset )
    }

    /**
     * update box shadow state value
     * 
     * @since 1.0.0
     */
    const updateBoxShadowState = ( property, val ) => {
        setBoxShadow({ ...boxShadow, [property]: val })
    }

    return(
        <>
            <BlogmaticControlHeader label={ label } description={ description }>
                <Dashicon icon='image-rotate' className="reset-button" onClick={() => setBoxShadow( defaultValue )}/>
            </BlogmaticControlHeader>
            <div className="control-inner-content">
                <Dropdown
                    popoverProps={{resize:false,noArrow:false,flip:true,variant:"unstyled",placement:'bottom-end'}}
                    contentClassName="blogmatic-box-shadow-control-popover"
                    renderToggle={ ( { isOpen, onToggle } ) => (
                        <div className="box-shadow-value-holder">
                            <div className="box-shadow-summ-value" onClick={ onToggle } aria-expanded={ isOpen }>
                                <div className="summ-vals">
                                    { 
                                        option ? <>
                                            <span className="summ-val">{`${hoffset}H`}</span><i>/</i>
                                            <span className="summ-val">{`${voffset}V`}</span><i>/</i>
                                            <span className="summ-val">{`${blur}px`}</span><i>/</i>
                                            <span className="summ-val">{`${spread}px`}</span>
                                        </> :
                                        <span className="summ-val">{ __( escapeHTML( 'None' ), 'blogmatic-pro' ) }</span>
                                    }
                                </div>
                                <span className="append-icon dashicons dashicons-ellipsis"></span>
                            </div>
                        </div>
                    )}
                    renderContent={ () => <ul className="inner-fields">
                            <li className="inner-field">
                                <ToggleControl
                                    label = { __( escapeHTML( "Enable" ), 'blogmatic-pro' ) }
                                    checked = { option }
                                    onChange = { () => updateBoxShadowState( 'option', ( ! option ) ) }
                                />
                            </li>
                            {
                                Object.entries( rangeControlObject ).map(([ property, propertyLabel ]) => {
                                    return <li className="inner-field">
                                        <RangeControl
                                            label = { propertyLabel }
                                            value = { boxShadow[property] }
                                            onChange = {( newValue ) => updateBoxShadowState( [property], newValue )}
                                            min = { -100 }
                                            max = { 100 }
                                            step = { 1 }
                                        />
                                    </li>
                                })
                            }
                            <li className="inner-field">
                                <ButtonGroup className="control-inner">
                                    <Button variant={ type == 'outset' ? 'primary' : 'secondary' } onClick={() => updateBoxShadowState( 'type', 'outset') }>{ __( escapeHTML( 'Outset' ), 'blogmatic-pro' ) }</Button>
                                    <Button variant={ type == 'inset' ? 'primary' : 'secondary' } onClick={() => updateBoxShadowState( 'type', 'inset') }>{ __( escapeHTML( 'Inset' ), 'blogmatic-pro' ) }</Button>
                                </ButtonGroup>
                            </li>
                        </ul>
                    }
                />
                { ( option ) &&
                    <Dropdown
                        popoverProps = {{ resize:false, noArrow:false, flip:true, variant:"unstyled", placement:'bottom-end' }}
                        contentClassName = "blogmatic-box-shadow-control-popover"
                        renderToggle = { ( { isOpen, onToggle } ) => (
                            <Tooltip placement="top" delay={200} text={ __( escapeHTML( 'Initial' ), 'blogmatic-pro' ) }>
                                <span className={ "color-indicator-wrapper" + ( isPreset ? ' preset-isactive' : '' ) }>
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
                                    <PresetComponent handlePresetClick={ handlePresetColorClick } color={ color } />
                                </ul>
                            </div>
                            <ColorPicker
                                color = { activeColor }
                                onChange = { ( newColor ) => updateBoxShadowState( 'color', newColor ) }
                                enableAlpha
                            />
                        </> }
                    />
                }
            </div>
        </>
    )
}