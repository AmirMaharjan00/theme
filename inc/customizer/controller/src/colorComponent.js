const { ColorPicker, ColorIndicator, Dropdown, Tooltip, TabPanel, GradientPicker, Button, ResponsiveWrapper, SelectControl, ButtonGroup, Dashicon } = wp.components;
const { useState, useEffect, useMemo } = wp.element;
const { escapeHTML } = wp.escapeHtml;
const { MediaUpload } = wp.blockEditor;
const { __ } = wp.i18n;
const { customize } = wp;
import { PresetComponent, BlogmaticControlHeader, useBlogmaticColorPresets } from './component-function'

export function BlogmaticColorComponent( props ) {
    const [ value, setValue ] = useState( props.value )
    const { label, description, involve, hover } = customize.settings.controls[ props.setting ]

    useEffect(() => {
        customize.value( props.setting )( value )
    }, [ value ])

    // MARK: COLOR COMPONENT MAIN RETURN
    return (
        <div className="field-main">
            <BlogmaticReusableColorComponent 
                label = { label }
                description = { description }
                value = { value }
                menus = { involve }
                hover = { hover }
                setValue = { setValue }
            />
        </div>
    );
}

export const BlogmaticReusableColorComponent = ( props ) => {
    const { label, description, value, menus, hover, setValue } = props
    let tabMenus = []
    if( menus.includes( 'solid' ) ) tabMenus = [ ...tabMenus, { name: 'solid', title: __( 'Solid', 'blogmatic-pro' ), className: 'tab-solid', disabled: ( menus.length <= 1 ) } ]
    if( menus.includes( 'gradient' ) ) tabMenus = [ ...tabMenus, { name: 'gradient', title: __( 'Gradient', 'blogmatic-pro' ), className: 'tab-gradient', disabled: ( menus.length <= 1 ) } ]
    if( menus.includes( 'image' ) && ! hover ) tabMenus = [ ...tabMenus, { name: 'image', title: __( 'Image', 'blogmatic-pro' ), className: 'tab-image', disabled: ( menus.length <= 1 ) } ]

    return (
        <>
            <BlogmaticControlHeader label={ label } description={ description } />
            <div className="field-wrap">
                <DropDownComponent
                    setValue = { setValue }
                    value = { value }
                    menus = { tabMenus }
                    hover = { hover }
                />
                { hover && <DropDownComponent 
                    setValue = { setValue }
                    value = { value }
                    menus = { tabMenus }
                    hover = { true }
                    isInitial = { false }
                /> }
            </div>
        </>
    )
}
BlogmaticReusableColorComponent.defaultProps = {
    label: '',
    description: '',
    value: '',
    menus: '',
    hover: '',
    setValue: function(){}
}

/**
 * Solid color component
 * MARK: SOLID COLOR
 * 
 * @since 1.0.0
 */
const SolidColorComponent = ( props ) => {
    const { color, setColor, variable } = props
    const presetSetterFunction = ( presetColor ) => {
        setColor({ type: 'solid', solid: presetColor })   
    }

    /**
     * Handle on change event
     * 
     * @since 1.0.0
     */
    const handleOnChange = ( data ) => {
        setColor({ type: 'solid', solid: data })
    }

    return(
        <>
            <div className="preset-colors">
                <ul className="preset-colors-inner">
                    <PresetComponent handlePresetClick = { presetSetterFunction } color={ variable } />
                </ul>
            </div>
            <ColorPicker
                color = { color }
                onChange = { handleOnChange }
                enableAlpha
            />
        </>
    );
}

/**
 * Gradient Color Component
 * MARK: GRADIENT COLOR
 * 
 * @since 1.0.0
 */
const GradientColor = ( props ) => {
    const { color, setColor, variable } = props
    const presetSetterFunction = ( presetColor ) => {
        setColor({ type: 'gradient', gradient: presetColor })   
    }

    /**
     * Handle on change event
     * 
     * @since 1.0.0
     */
    const handleOnChange = ( data ) => {
        setColor({ type: 'gradient', gradient: data })
    }

    return(
        <>
            <div className="preset-colors">
                <ul className="preset-colors-inner">
                    <PresetComponent handlePresetClick = { presetSetterFunction } presetType = 'gradient'  color={ variable } />
            </ul>
            </div>
            <GradientPicker
                value = { color }
                onChange = {( data ) => handleOnChange( data )}
                __nextHasNoMargin={true}
                gradients={[]}
            />
        </>
    );
}

/**
 * Color Indicator and Dropdown component
 * 
 * @since 1.0.0
 * MARK: DROPDOWN
 */
const DropDownComponent = ( props ) => {
    const { value, menus, hover, isInitial, ...rest } = props
    const [ imageSettings, setImageSettings ] = useState( false )
    const currentType = hover ? value[ isInitial ? 'initial' : 'hover' ].type : value.type
    const currentColor = hover ? value[ isInitial ? 'initial' : 'hover' ][currentType] : value[currentType]
    const { isPreset, getColorsAndVariables } = useBlogmaticColorPresets( currentColor )
    const allVariables = getColorsAndVariables()
    const activeColor = allVariables[currentColor] === undefined ? currentColor : allVariables[currentColor]

    const toolTipLabel = useMemo(() => {
        if( hover ) {
            if( isInitial ) {
                return "Initial"
            } else {
                return "Hover"
            }
        } else {
            switch( value.type ) {
                case 'solid':
                    return 'Solid'
                    break;
                case 'gradient':
                    return 'Gradient'
                    break;
                case 'image':
                    return 'Image'
                    break;
            }
        }
    }, [ value ])

    /**
     * Update value state
     * 
     * @since 1.0.0 
     */
    const updateValueState = ( updatedValue ) => {
        if( hover ) {
            rest.setValue({ ...value, [ isInitial ? 'initial' : 'hover' ]: updatedValue })
        } else {
            rest.setValue( updatedValue )
        }
    }

    return <Dropdown
        popoverProps={{ resize:false, noArrow:false, flip:true, variant:"unstyled", placement:'bottom-end' }}
        contentClassName="blogmatic-color-control-popover"
        renderToggle={ ( { isOpen, onToggle } ) => (
            // isInitial ? 'Initial' : 'Hover'
            <Tooltip placement="top" delay={ 200 } text={ __( escapeHTML( toolTipLabel ), 'blogmatic-pro' ) }>
                <span className={ "color-indicator-wrapper " + ( isPreset ? ' preset-isactive' : '' )  }>
                    { 
                        currentType !== 'image' ?
                        <ColorIndicator 
                            className = { currentColor === null && "null-color" }
                            colorValue = { activeColor }
                            onClick = { onToggle }
                            aria-expanded = { isOpen }
                        /> : 
                        <Dashicon 
                            icon = "format-image"
                            className = "null-color type--image"
                            onClick = { onToggle }
                            aria-expanded = { isOpen }
                        />
                    }
                </span>
            </Tooltip>
        ) }
        renderContent={ () => <>
            <TabPanel
                className = "blogmatic-group-tab-panel"
                activeClass = "active-tab"
                initialTabName = { currentType }
                tabs = { menus }
                >
                { ( tab ) => {
                    switch( tab.name ) {
                        case "solid" :
                            return <SolidColorComponent
                                color = { activeColor }
                                variable = { currentColor }
                                setColor = { updateValueState }
                            />
                            break;
                        case "gradient" :
                            return <GradientColor
                                color = { activeColor }
                                variable = { currentColor }
                                setColor = { updateValueState }
                            />
                            break;
                        case "image" : 
                            if( value.image === undefined ) {
                                value.image = { id: 0, url: '' }
                            }
                            const { position = 'left top', attachment = 'fixed', size = 'auto', repeat = 'no-repeat' } = value 
                            return (
                                <>
                                    <div className="editor-post-featured-image">
                                        <MediaUpload
                                            onSelect = {( media ) => updateValueState({ type: 'image', image:{ id: media.id, url: media.url } })}
                                            value = { value.image.url }
                                            allowedTypes = { ['image'] }
                                            render = {({open}) => (
                                                <Button 
                                                    className={ value.image.id === 0 ? 'editor-post-featured-image__toggle' : 'editor-post-featured-image__preview'}
                                                    onClick={ open }
                                                >
                                                    { value.image.id == 0 && __('Choose an image', 'blogmatic-pro') }
                                                    {( value.image !== undefined && value.image.id !== 0 && value.image.url !== '' ) &&
                                                        <ResponsiveWrapper
                                                            naturalWidth={ 200 }
                                                            naturalHeight={ 200 }
                                                        >
                                                            <img src = { value.image.url } />
                                                        </ResponsiveWrapper>
                                                        }
                                                </Button>
                                            )}
                                        />
                                        { value.image.id !== 0 && 
                                            <>
                                                <MediaUpload
                                                    title = { __('Replace image', 'blogmatic-pro') }
                                                    value = { value.image.id }
                                                    onSelect = {( media ) => updateValueState({ type: 'image', image:{ id: media.id, url: media.url } }) }
                                                    allowedTypes = { ['image'] }
                                                    render = {({ open }) => (
                                                        <Button onClick={ open } variant="secondary" isLarge>{ __('Replace image', 'blogmatic-pro') }</Button>
                                                    )}
                                                />
                                                <Button onClick={() => updateValueState({ type: 'image', image:{ id: 0, url: '' } })} isLink isDestructive>{ __('Remove image', 'blogmatic-pro') }</Button>
                                            </>
                                        }
                                    </div>
                                    { ( value.image.id !== 0 ) && <div className="more-settings">
                                        <Button 
                                            variant = "tertiary"
                                            isSmall = { true }
                                            iconPosition = "right"
                                            icon = { imageSettings ? 'arrow-up-alt' : 'arrow-down-alt'}
                                            onClick = {() => setImageSettings( ! imageSettings )}
                                        >
                                                { imageSettings ? __( 'Show less settings!', 'blogmatic-pro') : __( 'Show more settings!', 'blogmatic-pro') }
                                        </Button>
                                        { ( imageSettings ) &&
                                            <>
                                                <SelectControl
                                                    label = { __( 'Background Position', 'blogmatic-pro') }
                                                    value = { position }
                                                    options = { [
                                                        { label: 'Left Top', value: 'left top' },
                                                        { label: 'Left Center', value: 'left center' },
                                                        { label: 'Left Bottom', value: 'left bottom-end' },
                                                        { label: 'Right Top', value: 'right top' },
                                                        { label: 'Right Center', value: 'right center' },
                                                        { label: 'Right Bottom', value: 'right bottom-end' },
                                                        { label: 'Center Top', value: 'center top' },
                                                        { label: 'Center Center', value: 'center center' },
                                                        { label: 'Center Bottom', value: 'center bottom-end' }
                                                    ] }
                                                    onChange = { ( newPosition ) => updateValueState({ ...value, position: newPosition }) }
                                                />
                                                <SelectControl
                                                    label = { __( 'Background Repeat', 'blogmatic-pro') }
                                                    value = { repeat }
                                                    options = { [
                                                        { label: 'No Repeat', value: 'no-repeat' },
                                                        { label: 'Repeat All', value: 'repeat' },
                                                        { label: 'Repeat Horizontally', value: 'repeat-x' },
                                                        { label: 'Repeat Vertically', value: 'repeat-y' }
                                                    ] }
                                                    onChange={ ( newRepeat ) => updateValueState( { ...value, repeat: newRepeat }) }
                                                />
                                                <div>
                                                    <div className="components-truncate components-text components-input-control__label">{ __( 'Background Attachment', 'blogmatic-pro') }</div>
                                                    <ButtonGroup>
                                                        <Button variant={ attachment == 'fixed' ? 'primary' : 'secondary' } onClick={() => updateValueState({ ...value, attachment: 'fixed' })}>{ __( 'Fixed', 'blogmatic-pro') }</Button>
                                                        <Button variant={ attachment == 'scroll' ? 'primary' : 'secondary' } onClick={() => updateValueState({ ...value, attachment: 'scroll' })}>{ __( 'Scroll', 'blogmatic-pro') }</Button>
                                                    </ButtonGroup>
                                                </div>
                                                <div>
                                                    <div className="components-truncate components-text components-input-control__label">{ __( 'Background Size', 'blogmatic-pro') }</div>
                                                    <ButtonGroup>
                                                        <Button variant={ size == 'auto' ? 'primary' : 'secondary' } onClick={() => updateValueState({ ...value, size: 'auto' })}>{ __( 'Auto', 'blogmatic-pro') }</Button>
                                                        <Button variant={ size == 'cover' ? 'primary' : 'secondary' } onClick={() => updateValueState({ ...value, size: 'cover' })}>{ __( 'Cover', 'blogmatic-pro') }</Button>
                                                        <Button variant={ size == 'contain' ? 'primary' : 'secondary' } onClick={() => updateValueState({ ...value, size: 'contain' })}>{ __( 'Contain', 'blogmatic-pro') }</Button>
                                                    </ButtonGroup>
                                                </div>
                                            </>
                                        }
                                    </div>}
                                </>
                            )
                            break;
                    }
                } }
            </TabPanel>
        </> }
    />
}
DropDownComponent.defaultProps = {
    hover: false,
    isInitial: true
}